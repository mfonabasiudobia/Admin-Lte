<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Support\Collection;

class ConfigRepository
{


    public static function all()
    {

        return  [
            'settings' => cache('setting')
        ];
    }
}
