<?php

namespace App\Http\Livewire\Admin\Setting\BusinessSetting;

use App\Http\Livewire\BaseComponent;
use App\Repositories\SettingRepository;

class TransactionMessage extends BaseComponent
{

    public $airtime_success_title, $airtime_success_description;

    public $data_success_title, $data_success_description;

    public $cable_tv_success_title, $cable_tv_success_description;

    public $electricity_success_title, $electricity_success_description;

    public $gift_card_success_title, $gift_card_success_description;

    public $airtime_swap_success_title, $airtime_swap_success_description;

    public $education_success_title, $education_success_description;

    public $betting_success_title, $betting_success_description;

    public $movie_ticket_success_title, $movie_ticket_success_description;

    public $airtime_swap_guide;

    public function mount()
    {

        $this->fill([
            'airtime_success_title' => gs()->airtime_success_title,
            'airtime_success_description' => gs()->airtime_success_description,

            'data_success_title' => gs()->data_success_title,
            'data_success_description' => gs()->data_success_description,

            'airtime_swap_guide' => gs()->airtime_swap_guide,

            'cable_tv_success_title' => gs()->cable_tv_success_title,
            'cable_tv_success_description' => gs()->cable_tv_success_description,

            'electricity_success_title' => gs()->electricity_success_title,
            'electricity_success_description' => gs()->electricity_success_description,

            'gift_card_success_title' => gs()->gift_card_success_title,
            'gift_card_success_description' => gs()->gift_card_success_description,

            'airtime_swap_success_title' => gs()->airtime_swap_success_title,
            'airtime_swap_success_description' => gs()->airtime_swap_success_description,

            'education_success_title' => gs()->education_success_title,
            'education_success_description' => gs()->education_success_description,

            'betting_success_title' => gs()->betting_success_title,
            'betting_success_description' => gs()->betting_success_description,

            'movie_ticket_success_title' => gs()->movie_ticket_success_title,
            'movie_ticket_success_description' => gs()->movie_ticket_success_description
        ]);
    }


    public function submit(SettingRepository $settingRepo)
    {

        try {

            $settingRepo->multipleUpdate([
                'airtime_success_title' => $this->airtime_success_title,
                'airtime_success_description' => $this->airtime_success_description,

                'data_success_title' => $this->data_success_title,
                'data_success_description' => $this->data_success_description,

                'airtime_swap_guide' => $this->airtime_swap_guide,

                'cable_tv_success_title' => $this->cable_tv_success_title,
                'cable_tv_success_description' => $this->cable_tv_success_description,

                'electricity_success_title' => $this->electricity_success_title,
                'electricity_success_description' => $this->electricity_success_description,

                'gift_card_success_title' => $this->gift_card_success_title,
                'gift_card_success_description' => $this->gift_card_success_description,

                'airtime_swap_success_title' => $this->airtime_swap_success_title,
                'airtime_swap_success_description' => $this->airtime_swap_success_description,

                'education_success_title' => $this->education_success_title,
                'education_success_description' => $this->education_success_description,

                'betting_success_title' => $this->betting_success_title,
                'betting_success_description' => $this->betting_success_description,

                'movie_ticket_success_title' => $this->movie_ticket_success_title,
                'movie_ticket_success_description' => $this->movie_ticket_success_description
            ]);

            toast()->success("Transaction Messages has been updated")->push();

            $this->emit('refresh');
        } catch (\Throwable $e) {

            toast()->danger("Failed to update Transaction Messages")->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.business-setting.transaction-message')->layout('layouts.admin-base');
    }
}
