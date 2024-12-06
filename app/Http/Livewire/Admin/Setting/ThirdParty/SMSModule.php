<?php

namespace App\Http\Livewire\Admin\Setting\ThirdParty;

use App\Http\Livewire\BaseComponent;
use App\Repositories\SettingRepository;
use AppHelper;

class SMSModule extends BaseComponent
{


    public $msg91_status, $msg91_template_id, $msg91_auth_key;
    public $paypal_status, $paypal_client_id, $paypal_secret;
    public $stripe_status, $stripe_published_key, $stripe_api_key;

    public function mount()
    {
        // AppHelper::hasPermissionTo('manage_settings');

        $msg91 = json_decode(cache('setting')->msg91_credentials);
        $paypal = json_decode(cache('setting')->paypal_credentails);
        $stripe = json_decode(cache('setting')->stripe_credentails);


        $this->fill([
            'msg91_status' => $msg91->status ?? NULL,
            'msg91_template_id' => $msg91->template_id ?? NULL,
            'msg91_auth_key' => $msg91->auth_key ?? NULL,

            'paypal_status' => $paypal->status ?? NULL,
            'paypal_client_id' => $paypal->client_id ?? NULL,
            'paypal_secret' => $paypal->secret ?? NULL,

            'stripe_status' => $stripe->status ?? NULL,
            'stripe_published_key' => $stripe->published_key ?? NULL,
            'stripe_api_key' => $stripe->api_key ?? NULL
        ]);
    }


    public function submitMsg91(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->singleUpdate('msg91_credentials', [
                'status' => $this->msg91_status,
                'template_id' => $this->msg91_template_id,
                'auth_key' => $this->msg91_auth_key
            ]);

            toast()->success("MSG 91 Credentials has been updated")->push();
            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update MSG 91 Credentials")->push();
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
        } catch (\Throwable $e) {

            toast()->danger("Failed to update Paypal Credentials")->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.setting.third-party.sms-module')->layout('layouts.admin-base');
    }
}
