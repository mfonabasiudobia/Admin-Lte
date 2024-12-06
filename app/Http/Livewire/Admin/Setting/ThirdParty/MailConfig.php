<?php

namespace App\Http\Livewire\Admin\Setting\ThirdParty;

use App\Http\Livewire\BaseComponent;

class MailConfig extends BaseComponent
{
    public function render()
    {
        return view('livewire.admin.setting.third-party.mail-config')->layout('layouts.admin-base');
    }
}
