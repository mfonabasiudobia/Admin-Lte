<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Models\PushNotification;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

class NotificationRepository
{

    public static function getUserNotification($userId): Collection
    {
        $user = User::where("email", "admin@econnectcards.com")->first(); //For all user notifications
        $user2 = auth()->user();

        $notifications = Notification::whereIn('user_id', [$user2->id, $user->id])
            ->latest()
            ->with(['sender', 'card', 'user'])
            ->where('created_at', '>', auth()->user()->created_at)
            ->when($user2->notification_deleted_at, function ($q) use ($user2) {
                $q->whereDate('created_at', '>=', $user2->notification_deleted_at);
            })
            ->get()
            ->take(50);

        Notification::whereIn('user_id', [$userId])
            ->latest()
            ->where('created_at', '>=', auth()->user()->created_at)
            ->update(['seen' => 1]);

        $user2->update(['notification_seen_at' => now()]);

        return $notifications;
    }

    public static function getNotificationCount()
    {
        try {
            $user = User::where("email", "admin@econnectcards.com")->first(); //For all user notifications
            $user2 = auth()->user();

            $notificationCount = Notification::whereIn('user_id', [$user2->id, $user->id])
                ->where('created_at', '>', auth()->user()->created_at)
                ->when($user2->notification_deleted_at, function ($q) use ($user2) {
                    $q->where('created_at', '>=', $user2->notification_deleted_at);
                })
                ->when($user2->notification_seen_at, function ($q) use ($user2) {
                    $q->where('created_at', '>=', $user2->notification_seen_at);
                })
                ->where('seen', 0)
                ->get()
                ->count();

            return $notificationCount;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function getPushNotificationById($id): PushNotification
    {
        return PushNotification::findOrFail($id);
    }

    public static function createPushNotification(array $data): PushNotification
    {
        send_push_notification($data);

        $notification = PushNotification::create($data);

        if ($data['can_save']) {
            $user = User::where('email', 'admin@econnectcards.com')->first();

            save_notification([
                'user_id' => $user->id,
                'image' => $user->profile_image,
                'title' => $data['title'],
                'content' => $data['content']
            ]);
        }


        return $notification;
    }

    public static function updatePushNotification(array $data, $id): bool
    {
        send_push_notification($data);

        return PushNotification::find($id)->update($data);
    }


    public static function delete(string $id, string $userId): bool
    {
        $notification = Notification::findOrFail($id);

        if ($notification) return $notification->delete();

        return false;
    }
}
