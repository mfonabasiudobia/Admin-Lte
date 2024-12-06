<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Repositories\WalletRepository;

class WithdrawJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)

    {
        $this->data = $data;
        $this->onQueue('withdrawjob');
    }

    /**
     * Execute the job.
     */
    public function handleRefund($trx, $withdrawal)
    {
        $trx->update(['status' => 'failed']);
        $withdrawal->update(['status' => 'failed']);

        // $trx->user->increment("wallet_balance", $trx->amount);
    }

    public function handle(): void
    {
        try {


            $trx = Transaction::where('trx', $this->data['trx'])->where('status', 'pending')->first();

            if ($trx) {
                $withdrawal = Withdrawal::where('trx', $this->data['trx'])->where('status', 'pending')->first();

                if ($withdrawal) {

                    if ($withdrawal->user->wallet_balance > $withdrawal->amount) {
                        $transfer = WalletRepository::safehevenpost("/transfers", [
                            'nameEnquiryReference' => $trx->query1['reference'],
                            'debitAccountNumber' => env('SAFEHEVEN_DEBIT_ACCOUNT'),
                            'beneficiaryBankCode' => $withdrawal->bank_id,
                            'beneficiaryAccountNumber' => $withdrawal->account_number,
                            'narration' =>  'Commission Withdrawal',
                            'amount' => (float) $withdrawal->amount,
                            'saveBeneficiary' => false,
                            'paymentReference' => $trx->trx,
                        ]);

                        Storage::put('withdraw_error.txt', json_encode($transfer));

                        $trx->update(['response' => force_string($transfer)]);


                        if (isset($transfer->statusCode) && isset($transfer->responseCode) && ($transfer->responseCode == '00') && ($transfer->statusCode == 200)) {
                            // if (strtolower($response['data']['status']) == 'completed') {

                            $trx->update(['status' => 'completed', 'trx' => $transfer->data->sessionId]);
                            $withdrawal->update(['status' => 'completed']);

                            $withdrawal->user()->decrement("wallet_balance", $withdrawal->amount);

                            $amount = number_format($withdrawal->amount);

                            save_notification([
                                'user_id' => $withdrawal->user_id,
                                'title' => 'Withdrawal Request',
                                'content' => "Request for withdrawal of ₦$amount is {$withdrawal->status}"
                            ]);

                            send_push_notification([
                                'title' => "Withdrawal Request",
                                'content' => "Request for withdrawal of ₦$amount has been {$withdrawal->status}"
                            ], $withdrawal->user->id);
                        } else {
                            $this->handleRefund($trx, $withdrawal);
                        }
                    } else {
                        $trx->update(['status' => 'failed']);
                        $withdrawal->update(['status' => 'failed']);
                    }
                }
            }
        } catch (\Throwable $th) {
            Storage::put('withdraw_error.txt', (string) $th);
        }
    }
}
