<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'fullname' => 'Super Admin',
            'email' => 'admin@admin.com',
            'referral_code' => '9393dh',
            'password' => bcrypt(123456)
        ]);

        $user->assignRole('Super Admin');
    }
}
