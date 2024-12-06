<?php

namespace App\Http\Livewire\Admin\Setting\ThirdParty;

use App\Http\Livewire\BaseComponent;
use App\Repositories\SettingRepository;
use AppHelper;

class PaymentMethods extends BaseComponent
{

    public $razor_status, $razor_key, $razor_secret;
    public $paypal_status, $paypal_client_id, $paypal_secret;
    public $stripe_status, $stripe_published_key, $stripe_api_key;

    public function mount()
    {
        // AppHelper::hasPermissionTo('manage_settings');

        $razor = json_decode(cache('setting')->razor_pay_credentails);
        $paypal = json_decode(cache('setting')->paypal_credentails);
        $stripe = json_decode(cache('setting')->stripe_credentails);


        $this->fill([
            'razor_status' => $razor->status ?? NULL,
            'razor_key' => $razor->key ?? NULL,
            'razor_secret' => $razor->secret ?? NULL,

            'paypal_status' => $paypal->status ?? NULL,
            'paypal_client_id' => $paypal->client_id ?? NULL,
            'paypal_secret' => $paypal->secret ?? NULL,

            'stripe_status' => $stripe->status ?? NULL,
            'stripe_published_key' => $stripe->published_key ?? NULL,
            'stripe_api_key' => $stripe->api_key ?? NULL
        ]);
    }


    public function submitRazor(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->singleUpdate('razor_pay_credentails', [
                'key' => $this->razor_key,
                'status' => $this->razor_status,
                'secret' => $this->razor_secret
            ]);

            toast()->success("Razor Pay Credentials has been updated")->push();
            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update Razor Pay Credentials")->push();
        }
    }


    public function submitPaypal(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->singleUpdate('paypal_credentails', [
                'status' => $this->paypal_status,
                'client_id' => $this->paypal_client_id,
                'secret' => $this->paypal_secret
            ]);

            toast()->success("Paypal Credentials has been updated")->push();
            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update Paypal Credentials")->push();
        }
    }


    public function submitStripe(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->singleUpdate('stripe_credentails', [
                'status' => $this->stripe_status,
                'published_key' => $this->stripe_published_key,
                'api_key' => $this->stripe_api_key
            ]);

            toast()->success("Paypal Credentials has been updated")->push();
            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update Paypal Credentials")->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.setting.third-party.payment-methods')->layout('layouts.admin-base');
    }
}
