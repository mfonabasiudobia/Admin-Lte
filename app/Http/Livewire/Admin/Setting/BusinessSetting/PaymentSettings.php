<?php

namespace App\Http\Livewire\Admin\Setting\BusinessSetting;

use App\Http\Livewire\BaseComponent;
use App\Repositories\SettingRepository;
use AppHelper;

class PaymentSettings extends BaseComponent
{

    public $price, $payment_note = '';


    public $personal_card_limit  = 'unlimited', $sport_card_limit = 'unlimited';

    public function mount()
    {
        // AppHelper::hasPermissionTo('manage_settings');

        $this->fill([
            'price' => gs()->price ?? 0,
            'payment_note' => gs()->payment_note ?? '',
            'personal_card_limit' => gs()->personal_card_limit ?? 'unlimited',
            'sport_card_limit' => gs()->sport_card_limit ?? 'unlimited'
        ]);
    }

    public function submit(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->multipleUpdate([
                'price' => $this->price,
                'payment_note' => $this->payment_note,
                'personal_card_limit' => $this->personal_card_limit,
                'sport_card_limit' => $this->sport_card_limit
            ]);

            toast()->success("Payment Setting has been updated")->push();

            $this->emit('refresh');
        } catch (\Throwable $e) {

            dd($e->getMessage());
            toast()->danger("Failed to update Payment Setting")->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.business-setting.payment-settings')->layout('layouts.admin-base');
    }
}
