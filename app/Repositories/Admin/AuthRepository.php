<?php

namespace App\Repositories\Admin;

class AuthRepository
{

    public static function login(object $data)
    {

        $user = auth()->attempt([
            'email' => $data->email,
            'password' => $data->password
        ], $data->rm);

        if ($user) {
            if (!auth()->user()->hasRole('Super Admin')) {
                auth()->logout();
            }
        }

        return auth()->user();
    }
}
