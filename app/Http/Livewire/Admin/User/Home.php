<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseComponent;
use App\Http\Traits\DeleteItem;
use AppHelper;

class Home extends BaseComponent
{

    public $remark = 'ACTIVE';

    public function mount()
    {
        AppHelper::hasPermissionTo('view_user');

        if (request()->has('remark')) {
            $this->remark = request('remark');
        }
    }

    public function render()
    {
        return view('livewire.admin.user.home')->layout('layouts.admin-base');
    }
}
