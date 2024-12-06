<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{


    public static function singleUpdate($key, $value): bool
    {
        return Setting::where('key', $key)->first()->update(['value' => $value]);
    }

    // public static function multipleUpdate($data)
    // {

    //     foreach ($data as $key => $value) {
    //         $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    //     }

    //     return true;



    // }


    public static function multipleUpdate($data)
    {

        foreach ($data as $key => $value) {
            $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return true;
    }
}
