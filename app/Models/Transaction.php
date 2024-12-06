<?php

namespace App\Models;

class Transaction extends BaseModel
{
    protected $casts = [
        'query1' => 'json',
        'response' => 'json',
        'query2' => 'json',
        'payload' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted($q)
    {
        $q->where("status", "completed");
    }

    public function getQuery1Attribute($value)
    {
        $data = json_decode($value, true);

        if (isset($data['image'])) {
            $data['image'] = asset($data['image']);
        }


        return $data;
    }
}
