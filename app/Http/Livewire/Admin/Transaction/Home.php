<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Http\Livewire\BaseComponent;
use AppHelper;

class Home extends BaseComponent
{
    public $status, $remark;

    public function mount()
    {
        $this->fill([
            'status' => request()->has('status') ? request('status') : 'all',
            'remark' => request()->has('remark') ? request('remark') : null
        ]);
    }


    public function render()
    {
        return view('livewire.admin.transaction.home')->layout('layouts.admin-base');
    }
}
