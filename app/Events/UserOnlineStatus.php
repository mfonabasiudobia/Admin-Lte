<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOnlineStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status,  $userId;
    public $cardId, $authId;

    public function __construct($status, $userId)
    {
        $this->status = $status;
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('online-status.' . $this->userId)
        ];
    }

    public function broadcastWith()
    {
        return ['status' => $this->status];
    }

    public function broadcastAs()
    {
        return 'UserStatusChanged';
    }
}
