<?php

use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Notification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

function gs()
{
    return (object) Setting::all()->pluck("value", "key")->toArray();
}

//Active Currency
function ac()
{
    return "$";
}


function force_string($data)
{
    return json_encode(json_encode($data));
}

function getTrx($length = 4)
{

    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $currentDateTime = now()->format("YmdHi");

    return $currentDateTime . $randomString;
}

function discount_amount($value, $amount, $discountType = 'fixed')
{
    if ($discountType == 'fixed') {
        return $value;
    }

    return round(($value / 100) * $amount, 2);
}

function upload_file($file, $filePath, $previousPath = null, $isupdating = false)
{
    if (!$file && $isupdating) return $previousPath; // return previous path if we updating file and file upload exists

    if (file_exists($previousPath)) unlink($previousPath);

    if (!$file) return null;

    return 'storage/' . $file->storeAs($filePath, Str::uuid() . '.' . $file->extension());
}



function account_limit($userId)
{
    $user = User::find($userId);

    if ($user->account_status == 'blocked') throw new \Exception("Your account has been blocked, please contact customer support.", 1);
}

function save_transaction($data)
{
    return Transaction::create([
        'user_id' => $data['user_id'],
        'amount' => $data['amount'],
        'trx' => $data['trx'],
        'discount_amount' => $data['discount_amount'] ?? 0,
        'charge' => $data['charge'],
        'profit' => $data['profit'] ?? 0,
        'quantity' => $data['quantity'] ?? 0,
        'price' => $data['price'] ?? 0,
        'payload' => $data['payload'] ?? null,
        'response' => $data['response'] ?? null,
        'trx_type' => $data['type'],
        'details' => $data['details'],
        'ip_address' => request()->getClientIp(),
        'timezone' => $data['timezone'] ?? null,
        'remark' => $data['remark'],
        'query1' => $data['query1'] ?? [],
        'query2' => $data['query2'] ?? [],
        'status' => $data['status'] ?? 'pending'
    ]);
}

function get_transaction($id)
{
    return Transaction::findOrFail($id);
}

function save_notification($data)
{
    return Notification::create([
        'user_id' => $data['user_id'],
        'title' => $data['title'],
        'card_id' => $data['card_id'] ?? null,
        'image' => $data['image'] ?? null,
        'sender_id' => $data['sender_id'] ?? null,
        'content' => $data['content'],
    ]);
}

function deduct_from_wallet($amount)
{
    return auth()->user()->decrement('wallet_balance', $amount);
}

function send_push_notification($data, $userId = null)
{
    $title = $data['title'] ?? null;
    $body = $data['content'] ?? null;
    // $image = isset($data['image']) ? asset($data['image']) : asset(gs()->logo);
    // $topic = is_null($userId) ? "/topics/all-users" : "/topics/user-$userId";

    $topic = is_null($userId) ? "all-users" : "user-$userId";

    // Construct the notification payload
    $notification = [
        'title' => $title,
        'body' => $body,
        // 'sound' => 'default'
        // 'image' => $image,
    ];

    try {
        $accessToken = getFCMAccessToken("google-services.json");

        $response = Http::withToken($accessToken)->post('https://fcm.googleapis.com/v1/projects/econnect-cards/messages:send', [
            'message' => [
                'topic' => $topic,
                'notification' => $notification,
                'android' => [
                    'priority'     => 'high',
                    "notification" => [
                        "sound" => "default"
                    ]
                ],
                "apns" => [
                    "payload" => [
                        "aps" => [
                            "sound" => "default",
                            "content-available" => 1,
                        ]
                    ],
                    "headers" => [
                        "apns-priority" => "10"
                    ]
                ],



                'data' => ['title' => $title, 'body' => $body],
            ],

        ]);
        $responseBody = $response->object();


        return $response->object();
    } catch (\Throwable $th) {
        dd($th);
        return $th;
    }
}

// Helper method to get OAuth 2.0 token
function getFCMAccessToken($credentialsFilePath)
{

    try {
        if (Cache::has('accesstokengoogle')) {
            return   Cache::get('accesstokengoogle');
        } else {
            $client = new \Google_Client();
            $client->setAuthConfig($credentialsFilePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $client->refreshTokenWithAssertion();
            $token = $client->getAccessToken();

            Cache::put("accesstokengoogle",  $token['access_token'], 2000);
            return $token['access_token'];
        }
    } catch (\Throwable $e) {
        Log::warning((string) force_string($e->getMessage()));
    }
}


function sanitize_image_array($images)
{
    $prefixToRemove = env("APP_URL") . "/";

    return array_map(function ($url) use ($prefixToRemove) {
        return str_replace($prefixToRemove, "", $url);
    }, $images);
}

function sanitize_image_path($unsanitizeImagePath)
{
    $prefixToRemove = env("APP_URL") . "/";

    return str_replace($prefixToRemove, '', $unsanitizeImagePath);
}


function ordinal($number)
{
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        $suffix = 'th';
    } else {
        switch ($number % 10) {
            case 1:
                $suffix = 'st';
                break;
            case 2:
                $suffix = 'nd';
                break;
            case 3:
                $suffix = 'rd';
                break;
            default:
                $suffix = 'th';
                break;
        }
    }

    return $number . $suffix;
}

function get_currency_symbol($currency)
{
    if ($currency === "USD") {
        return "$";
    } else if ($currency === "NAIRA") {
        return "₦";
    }
}
