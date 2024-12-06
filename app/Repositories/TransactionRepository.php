<?php

namespace App\Repositories;

use App\Models\Transaction;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Jobs\Mailable;
use App\Repositories\CardRepository;
use App\Mail\OrderUserNotification;
use Stripe\PaymentMethod;
use DB;
use Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Carbon\Carbon;

class TransactionRepository
{

    public static function transactionHistory($userId)
    {
        $transactions = Transaction::latest()
            ->where('user_id', $userId)
            ->get();

        return  $transactions;
    }

    public static function paymentVerification($userId, $data)
    {
        $cardId = $data['card_id'] ?? null;

        $quantity = 0; // set default to 0

        $trx = null;

        Log::warning((string) "Payload before card creation and verification for user $userId" . force_string($data));

        if (isset($data['platform']) && $data['platform'] == 'android' && isset($data[0]['transactionReceipt'])) {

            $response = json_decode($data[0]['transactionReceipt'], true);

            $product = Product::where('platform', $data['platform'])->where('productId', $response['productId'])->first();
            $quantity = $product->quantity;
            $platform = $data['platform'];
            $transactionId = $response['orderId'] ?? null;

            $trx = save_transaction([
                'user_id' => $userId,
                'charge' => 0,
                'amount' => $product->amount,
                'trx' => getTrx(),
                'type' => "+",
                'status' => 'completed',
                'quantity' => $quantity,
                'price' => $product->amount,
                'details' => "Purchase of $quantity business cards",
                'remark' => "BUSINESS_CARD",
                'timezone' => $data['timezone'],
                'query1' => [
                    'card_id' => $cardId ?? null,
                    'is_renewal' => $cardId ? true : false
                ],
                'query2' => [
                    'card_type' => 'business',
                    'platform' => $platform,
                    'transaction_id' => $transactionId,
                    'expires_at' => now()->addYear(),
                ],
                'response' => force_string($response)
            ]);


            if ($cardId) {
                $card = CardRepository::getById($cardId);

                $card->update(['expires_at' => now()->addYear(), 'status' => 'active', 'details' => 'Renewal of business card']);
            } else {
                $card = CardRepository::createDraftCard($userId, [
                    'quantity' => $quantity,
                ]);
            }

            dispatch(new Mailable($trx->user->email, new OrderUserNotification($trx)));
            dispatch(new Mailable("receipts@econnectcards.com", new OrderUserNotification($trx)));
        } else if (isset($data['transactionReceipt']) && isset($data['platform']) && $data['platform'] == 'ios') {


            // $response = Http::post("https://sandbox.itunes.apple.com/verifyReceipt", [
            //     "receipt-data" => $data['transactionReceipt'],
            //     "password" =>  "cc78fc5f6d3b42a1aeb49ae6a3a4464f"
            // ]);
            $response = Http::post("https://buy.itunes.apple.com/verifyReceipt", [
                "receipt-data" => $data['transactionReceipt'],
                "password" => "9cc0d95621ca4fa78c43783547d7c2ea"
            ]);

            $response = $response->json();

            Log::warning((string) "IOS Payment verification response for $userId" . force_string($response));

            if (!isset($response['receipt'])) {
                $response = Http::post(
                    "https://buy.itunes.apple.com/verifyReceipt",
                    [
                        "receipt-data" => $data['transactionReceipt'],
                        "password" => "9cc0d95621ca4fa78c43783547d7c2ea"
                    ]
                );

                $response = $response->json();
            }

            $productId = $response['receipt']['in_app'][0]['product_id'];
            $transactionId = $response['receipt']['in_app'][0]['product_id'];
            $platform = $data['platform'];
            $product = Product::where('platform', $platform)->where('productId', $productId)->first();

            $quantity = $product->quantity;

            $trx = save_transaction([
                'user_id' => $userId,
                'charge' => 0,
                'amount' => $product->amount,
                'trx' => getTrx(),
                'type' => "+",
                'status' => 'completed',
                'quantity' => $quantity,
                'price' => $product->amount,
                'details' => "Purchase of $quantity business cards",
                'remark' => "BUSINESS_CARD",
                'timezone' => $data['timezone'],
                'query1' => [
                    'card_id' => $cardId ?? null,
                    'is_renewal' => $cardId ? true : false
                ],
                'query2' => [
                    'card_type' => 'business',
                    'platform' => $platform,
                    'transaction_id' => $transactionId,
                    'expires_at' => now()->addYear(),
                ],
                'response' => force_string($response)
            ]);

            if ($cardId) {
                $card = CardRepository::getById($cardId);

                $card->update(['expires_at' => now()->addYear(), 'status' => 'active', 'details' => 'Renewal of business card']);
            } else {
                $card = CardRepository::createDraftCard($userId, [
                    'quantity' => $quantity,
                ]);
            }

            dispatch(new Mailable($trx->user->email, new OrderUserNotification($trx)));
            dispatch(new Mailable("receipts@econnectcards.com", new OrderUserNotification($trx)));
        }



        return $trx;
    }

    public static function placeOrder($userId, $data)
    {
        $clientSecret = $data['client_secret'];
        $cardId = $data['card_id'];

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntentId = explode('_secret_', $clientSecret)[0];

        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        $paymentMethod = PaymentMethod::retrieve($paymentIntent->payment_method);

        if ($paymentIntent->status === 'succeeded') {
            $quantity = $paymentIntent->metadata->quantity;
            $trx = save_transaction([
                'user_id' => $userId,
                'charge' => 2.04,
                'amount' => $paymentIntent->amount / 100,
                'trx' => getTrx(),
                'type' => "+",
                'status' => 'completed',
                'quantity' => $paymentIntent->metadata->quantity,
                'price' => $paymentIntent->metadata->price,
                'details' => "Purchase of $quantity business cards",
                'remark' => "BUSINESS_CARD",
                'query1' => [
                    'currency' => $paymentIntent->currency,
                    'client_secret' => $paymentIntent->client_secret,
                    'latest_charge' => $paymentIntent->latest_charge,
                    'payment_method' => $paymentIntent->payment_method,
                    'card_id' => $cardId ?? null,
                    'is_renewal' => $cardId ? true : false
                ],
                'response' => force_string($paymentIntent)
            ]);

            if ($cardId) {
                $card = CardRepository::getById($cardId);

                $card->update(['expires_at' => now()->addYear(), 'status' => 'active', 'details' => 'Renewal of business card']);
            } else {
                $card = CardRepository::createDraftCard($userId, [
                    'quantity' => $paymentIntent->metadata->quantity,
                ]);
            }

            $cardArray = [];

            if ($paymentMethod->card) {
                $cardArray = [
                    'last4' => $paymentMethod->card->last4,
                    'brand' => $paymentMethod->card->brand,
                    'country' => $paymentMethod->card->country,
                    'exp_month' => $paymentMethod->card->exp_month,
                    'exp_year' => $paymentMethod->card->exp_year
                ];
            }

            $trx->update(['query2' => array_merge([
                'card_type' => 'business',
                'expires_at' => now()->addYear(),
            ], $cardArray)]);


            dispatch(new Mailable($trx->user->email, new OrderUserNotification($trx)));

            return $trx;
        }

        return false;
    }

    public static function updateTransactionStatus($status, $id): bool
    {
        $transaction = Transaction::findOrFail($id);

        throw_if(in_array($transaction->status, ['cancelled', 'completed']), "You cannot change status of a completed transaction");

        // if (in_array($status, ['cancelled'])) {

        //     //Refund Amount to customer If transaction is cancelled
        //     $transaction->user()->increment("wallet_balance", $transaction->amount);

        //     save_transaction([
        //         'user_id' => $transaction->user_id,
        //         'charge' => 0,
        //         'amount' => $transaction->amount,
        //         'trx' => getTrx(),
        //         'type' => "+",
        //         'details' => "Refund from transaction cancelled",
        //         'remark' => "REFUND",
        //         'query1' => [
        //             'image' => "storage/2023/10/30/images/files/8899b715-83f5-4d05-ba45-66be69149b67.png"
        //         ]
        //     ]);
        // }
        return $transaction->update(['status' => $status]);
    }


    public static function resendTransactionInvoice($id): bool
    {
        $trx = Transaction::findOrFail($id);

        dispatch(new Mailable($trx->user->email, new OrderUserNotification($trx)));

        return true;
    }

    public static function generateSharableInvoice($id)
    {

        $model = self::getById($id);

        $cardType = $model->query2['card_type'] ?? null;
        $trx = ucwords($model->trx);
        $status = $model->status;
        $amount = number_format($model->amount);

        $price = number_format($model->price);
        $quantity = $model->quantity;

        $date = Carbon::parse($model->created_at)->format('d M, Y h:i A');

        $logo = asset(gs()->logo);


        return "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link
            href='https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,500;1,600;1,700;1,800&display=swap'
            rel='stylesheet'>
            <style>
                html,body {
                    font-family: 'Lato' !important;
                }
            </style>
        </head>

        <body>

            <section style='padding: 0px 50px;'>
                <br />
                <center><img src='$logo' style='border-radius: 50%;width: 100px; height: 100px'  /></center>
                <br />

                <br />
                <center>
                <div style='border: 1px solid #EDEDED;width: 70%;'></div>
                </center>
                <br />
                <table width='100%'>
                        <tbody>
                            <tr>
                                <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Transaction number</td>
                                <td width='50%' style='text-align: right;padding: 10px 0px;'>#$trx</td>
                            </tr>
                            <tr>
                                <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Purchased Date</td>
                                <td width='50%' style='text-align: right;padding: 10px 0px;'>$date</td>
                            </tr>

                            <tr>
                            <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Payment Method</td>
                            <td width='50%' style='text-align: right;padding: 10px 0px;'>Stripe</td>
                        </tr>

                        <tr>
                        <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Card Type</td>
                        <td width='50%' style='text-align: right;padding: 10px 0px;'>$cardType</td>
                    </tr>

                     <tr>
                                <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Transaction Status</td>
                                <td width='50%' style='text-align: right;padding: 10px 0px;'>$status</td>
                            </tr>



                               <tr>
                                <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Quantity</td>
                                <td width='50%' style='text-align: right;padding: 10px 0px;'>$quantity</td>
                            </tr>

                               <tr>
                                <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Price</td>
                                <td width='50%' style='text-align: right;padding: 10px 0px;'>$$price</td>
                            </tr>

                    <tr>
                                <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Total Amount</td>
                                <td width='50%' style='text-align: right;padding: 10px 0px;'>$$amount</td>
                            </tr>





                        </tbody>
                    </table>
            </section>
        </body>
        </html>
        ";
    }



    public static function bulkExport($userId)
    {
        $logo = asset(gs()->logo);
        $table = "";

        $transactions = Transaction::where('user_id', $userId)->get();
        foreach ($transactions as $key => $transaction) {
            $trx = $transaction->trx;
            $date = Carbon::parse($transaction->created_at)->format('d M, Y h:i A');
            $expiryDate = Carbon::parse($transaction->query2['expires_at'])->format('d M, Y h:i A');
            $type = ucwords($transaction->query2['card_type'] ?? null);
            $amount = number_format($transaction->amount);

            $table .= "<tr>
                    <td>$trx</td>
                    <td>$date</td>
                    <td>$type</td>
                     <td>$expiryDate</td>
                    <td>$ {$amount}</td>
           </tr>";
        }


        return "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link
            href='https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,500;1,600;1,700;1,800&display=swap'
            rel='stylesheet'>
            <style>
                html,body {
                    font-family: 'Lato' !important;
                }
            </style>
        </head>

        <body>

            <section style='padding: 0px 50px;'>
                <br />
                <center><img src='$logo' style='border-radius: 50%;width: 100px; height: 100px'  /></center>
                <br />

                <br />
                <center>
                <div style='border: 1px solid #EDEDED;width: 70%;'></div>
                </center>
                <br />
                <table width='100%'>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Ex. Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>


                            $table



                        </tbody>
                    </table>
            </section>
        </body>
        </html>
        ";
    }


    public static function getById(string $id): Transaction
    {
        return Transaction::findOrFail($id);
    }

    public static function previousTransaction(string $id)
    {
        return Transaction::where('id', '<', $id)->latest()->first();
    }

    public static function nextTransaction(string $id)
    {
        return Transaction::where('id', '>', $id)->first();
    }
}
