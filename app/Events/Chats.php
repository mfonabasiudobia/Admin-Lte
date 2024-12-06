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

class Chats implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data,  $userId;
    public $cardId, $authId;

    public function __construct($data, $userId, $cardId, $authId)
    {
        $this->data = $data;
        $this->userId = $userId;
        $this->cardId = $cardId;
        $this->authId = $authId;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('chats.' . $this->userId . '.' . $this->cardId . '.' . $this->authId)
        ];
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->data
        ];
    }

    public function broadcastAs()
    {
        return 'Chats';
    }
}
