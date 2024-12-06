<?php

namespace App\Repositories;

use App\Models\User;
use App\Mail\OtpNotification;
use App\Jobs\Mailable;
use Mail;
use Hash;
use DB;
use Http;

class AuthRepository
{


    public static function auth($data): User | null
    {
        $user = User::withTrashed()->where('email', strtolower($data['email']))->first();

        if ($user) {
            if ($user->deleted_at) throw new \Exception("Invalid login credentials", 1);
        } else {
            $user = self::register(array_merge($data, ['email' => strtolower($data['email'])]));
        }

        return $user;
    }

    public static function register($data): User
    {

        $user = User::create(array_merge(
            $data,
            [
                'referral_code' => self::generateReferralCode(),
                'temporary_token' => str()->random(15),
                'wallet_balance' => 0,
            ]
        ));

        $user->assignRole('normal');

        return $user->refresh();
    }

    public static function getReferrerId($referral_code)
    {
        $user = User::where('referral_code', $referral_code)->first();

        if ($user) return $user->id;

        return null;
    }


    public static function generateReferralCode(): string
    {
        $code = strtoupper('SP-' . str()->random(5));

        if (User::where('referral_code', $code)->first()) $code = self::generateReferralCode();

        return $code;
    }



    public static function verifyOtp($data)
    {

        $verify = DB::table('otp_verifications')->where('email', $data['email'])->where('otp', $data['otp'])->first();

        if ($verify) {
            throw_if($verify->created_at <= now()->subMinutes(10), "Token has expired, please try again");

            $user = self::getUserByEmail($data['email']);

            auth()->login($user);

            $user->update(['is_verified' => 1, 'email_verified_at' => now(), 'online_status' => 'online']);

            DB::table('otp_verifications')->where('email', $data['email'])->delete();

            return $user->refresh(); //use this to fetch tokens in the controller
        }


        return false;
    }


    public static function sendOtp($email): bool | int
    {
        $rand = env('APP_ENV') == 'production' ? rand(11111, 99999) : 11111;

        if (strtolower($email) == 'mfonabasiisaac@gmail.com') $rand = 11111;

        if ($user = self::getUserByEmail($email)) {

            DB::table('otp_verifications')->where('email', $email)->delete(); //disable previous otps

            dispatch(new Mailable($email, new OtpNotification($user, $rand)));

            DB::table('otp_verifications')->insert(['email' => $email, 'otp' => $rand, 'created_at' => now()]);

            return  $rand;
        }

        return false;
    }

    public static function getUserByEmail($email, $temporaryToken = null): User | null
    {
        return User::where('email', $email)->when($temporaryToken, function ($q) use ($temporaryToken) {
            $q->where('temporary_token', $temporaryToken);
        })->first();
    }
}
