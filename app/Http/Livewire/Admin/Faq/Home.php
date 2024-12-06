<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Http\Livewire\BaseComponent;

class Home extends BaseComponent
{
    public function render()
    {
        return view('livewire.admin.faq.home')->layout('layouts.admin-base');
    }
}
