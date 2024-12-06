<?php

namespace App\Http\Livewire\Admin\Setting\BusinessSetting;

use App\Http\Livewire\BaseComponent;
use App\Repositories\SettingRepository;
use AppHelper;

class NotificationSettings extends BaseComponent
{

    public $server_key, $fcm_project_id;

    public function mount()
    {
        // AppHelper::hasPermissionTo('manage_settings');

        $this->fill([
            'server_key' => gs()->server_key,
            'fcm_project_id' => gs()->fcm_project_id
        ]);
    }


    public function submit(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->multipleUpdate([
                'server_key' => $this->server_key,
                'fcm_project_id' => $this->fcm_project_id
            ]);

            toast()->success("Notification Setting has been updated")->push();

            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update Notification Setting")->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.setting.business-setting.notification-settings')->layout('layouts.admin-base');
    }
}
