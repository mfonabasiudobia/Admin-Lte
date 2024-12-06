<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Hash;

class UserRepository
{


    public static function all(): LengthAwarePaginator
    {
        return User::paginate(20);
    }

    public static function getUserById(string $id): User
    {
        return User::findOrFail($id);
    }

    public static function createUser(array $data): User
    {
        $user = User::create(array_merge($data, ['password' => bcrypt($data['password'])]));

        $user->assignRole('normal');

        return $user;
    }



    public static function updateEmail(array $data, string $id): User | bool
    {
        $user = User::find($id);

        $user->update(['email' => $data['new_email'], 'is_verified' => 0]);

        return AuthRepository::sendOtp($data['new_email']);
    }

    public static function updateUser(array $data, string $id): User
    {
        $user = User::find($id);

        $isVerified = $user->email == $data['email'] ? 1 : 0;

        $user->update(array_merge($data, ['is_verified' => $isVerified]));

        return $user->refresh();
    }



    public static function updateNotification(array $data, string $id): User
    {
        $user = User::find($id);

        $user->update([
            'birthday_notification' => $data['birthday_notification'] ?? $user->birthday_notification,
            'status_notification' => $data['status_notification']  ?? $user->birthday_notification,
            'card_notification' => $data['card_notification']  ?? $user->birthday_notification,
        ]);

        return $user->refresh();
    }



    public static function getReferrals(string $userId): Collection
    {
        return User::where('referrer_id', $userId)->select('fullname', 'is_verified', 'created_at')->get();
    }

    public static function updateProfileImage(array $data, string $id): User
    {
        $user = User::find($id);

        $user->update([
            'profile_image' => upload_file($data['profile_image'], 'profile')
        ]);

        return $user->refresh();
    }

    public static function updateUserStatus($user, array $data): User
    {
        $user->update(['account_status' => $data['account_status']]);

        return $user->refresh();
    }

    public static function resetPassword(array $data, string $id): bool | User
    {

        throw_unless(Hash::check($data['old_password'], auth()->user()->password), "Old Password does not match!");

        return auth()->user()->update([
            'password' => bcrypt($data['new_password'])
        ]);
    }

    public static function deleteAccount(string $id, string $reason): bool
    {
        $user = User::find($id);

        $user->update(['delete_reason' => $reason]);

        return $user->delete();
    }


    public static function previousUser(string $id)
    {
        return User::where('id', '<', $id)->latest()->first();
    }

    public static function nextUser(string $id)
    {
        return User::where('id', '>', $id)->first();
    }
}
