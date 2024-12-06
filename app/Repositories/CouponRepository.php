<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Models\User;

class CouponRepository {


    public static function getCouponById(int $couponId) : Coupon 
    {
            return Coupon::findOrFail($couponId);
    }


    public static function createCoupon(object $data) : Coupon
    {
         $coupon = Coupon::create([
            'name' => $data->name,
            'code' => $data->code,
            'type' => $data->type,
            'discount' => $data->discount,
            'limit' => $data->limit
         ]);

        return $coupon;
    }

    public static function updateCoupon(object $data, int $id) : Coupon
    {
         $coupon = Coupon::find($id);
         
         $coupon->update([
            'name' => $data->name,
            'code' => $data->code,
            'type' => $data->type,
            'discount' => $data->discount,
            'limit' => $data->limit
         ]);


        return $coupon;
    }

    public static function calculateCouponDiscount($type, $amount, $discountvalue){
        if($type == 'fixed') return $discountvalue;

        return round(($discountvalue/100)*$amount, 2);
    }

    public static function applyCoupon(string $couponCode) : Coupon | null  {
        $coupon = Coupon::where("code", $couponCode)->where('status', 1)->where('limit', '>', 0)->first();

        if($coupon) $coupon->decrement('limit');

        return $coupon;
    }


    public static function generateCode() : string {
        $code = str()->random(5);

        if(Coupon::where('code', $code)->first()){
            $code = self::generateCode(); //using recursive function to generate unique coupon code
        }

        return $code;
    }



}
