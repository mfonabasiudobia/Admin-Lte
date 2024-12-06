<?php

namespace App\Models;

class Notification extends BaseModel
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class)->with(['user']);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
