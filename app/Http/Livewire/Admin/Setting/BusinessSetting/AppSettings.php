<?php

namespace App\Http\Livewire\Admin\Setting\BusinessSetting;

use App\Http\Livewire\BaseComponent;
use App\Repositories\SettingRepository;
use App\Repositories\VirtualCardRepository;

use AppHelper;

class AppSettings extends BaseComponent
{

    public $app_minimum_version_android, $app_minimum_version_ios, $app_url_android, $app_url_ios;


    public $terms_and_condition_url, $privacy_policy_url, $about_us_url, $help_and_support_url, $facebook_url;

    public $twitter_url, $linkedin_url;

    public $whatsapp_url, $instagram_url, $live_chat_url;

    public function mount()
    {
        // AppHelper::hasPermissionTo('manage_settings');


        $this->fill([
            'app_minimum_version_android' => gs()->app_minimum_version_android,
            'app_minimum_version_ios' => gs()->app_minimum_version_ios,
            'app_url_android' => gs()->app_url_android,
            'app_url_ios' => gs()->app_url_ios,

            'terms_and_condition_url' => gs()->terms_and_condition_url,
            'privacy_policy_url' => gs()->privacy_policy_url,
            'about_us_url' => gs()->about_us_url,
            'help_and_support_url' => gs()->help_and_support_url,
            'facebook_url' => gs()->facebook_url,
            'twitter_url' => gs()->twitter_url,
            'linkedin_url' => gs()->linkedin_url,

            'twitter_url' => gs()->twitter_url,
            'whatsapp_url' => gs()->whatsapp_url,

            'instagram_url' => gs()->instagram_url,

            'live_chat_url' => gs()->live_chat_url ?? null,


        ]);
    }


    public function submit(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->multipleUpdate([
                'app_minimum_version_android' => $this->app_minimum_version_android,
                'app_minimum_version_ios' => $this->app_minimum_version_ios,
                'app_url_android' => $this->app_url_android,
                'app_url_ios' => $this->app_url_ios,
                'terms_and_condition_url' => $this->terms_and_condition_url,
                'privacy_policy_url' => $this->privacy_policy_url,
                'about_us_url' => $this->about_us_url,
                'help_and_support_url' => $this->help_and_support_url,
                'facebook_url' => $this->facebook_url,
                'twitter_url' => $this->twitter_url,
                'linkedin_url' => $this->linkedin_url,
                'whatsapp_url' => $this->whatsapp_url,
                'instagram_url' => $this->instagram_url,
                'live_chat_url' => $this->live_chat_url,
            ]);


            toast()->success("App Config has been updated")->push();

            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update App Config")->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.setting.business-setting.app-settings')->layout('layouts.admin-base');
    }
}
