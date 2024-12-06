<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repositories\NotificationRepository;

class User extends AuthenticatableBaseModel
{
    use HasRoles, HasUuids, SoftDeletes;

    protected $guard_name = 'api';


    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $appends = [
        'notification_count',
        'message_count',
        'fullname'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'wallet_balance' => 'decimal:2',
        'is_verified' => 'bool',
        'birthday_notification' => 'bool',
        'status_notification' => 'bool',
        'card_notification' => 'bool'
    ];


    public function getProfileImageAttribute($value)
    {
        return asset($value);
    }


    public function getNotificationCountAttribute()
    {
        return NotificationRepository::getNotificationCount();
    }

    public function getMessageCountAttribute()
    {
        return Message::where('receiver_id', auth()->id())->whereNull('read_at')->count();
    }

    public function scopeIsConnection($q, $id)
    {
        $loggedInUserId = auth()->id();

        $isConnection = Connection::where('user_id', $loggedInUserId)->whereHas('card', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->first();

        if (!$isConnection) {
            $isConnection = Connection::where('user_id', $id)->whereHas('card', function ($q) use ($loggedInUserId) {
                $q->where('user_id', $this->id);
            })->first();
        }

        return $isConnection ? true : false;
    }

    public function getFullnameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
