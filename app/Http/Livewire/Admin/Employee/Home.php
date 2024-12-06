<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Http\Livewire\BaseComponent;
use App\Http\Traits\DeleteItem;
use AppHelper;

class Home extends BaseComponent
{

    public function mount(){
        AppHelper::hasPermissionTo('manage_employee');
    }

    public function render()
    {
        return view('livewire.admin.employee.home')->layout('layouts.admin-base');
    }
}
