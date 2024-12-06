<?php

namespace App\Http\Livewire\Admin\Permission;

use App\Http\Livewire\BaseComponent;
use App\Models\Permission;
use AppHelper;

class Create extends BaseComponent
{

    public $name;

    public function mount(){
        // AppHelper::hasPermissionTo('manage_employee');
    }

    public function submit(){

        $this->validate([
            'name' => 'required'
        ]);

        try {
            Permission::create([
               'name' => $this->name 
            ]);

            toast()->success('Permission has been created')->pushOnNextPage();
            
            redirect()->route("admin.permission.list");

        } catch (\Exception $e) {
            return toast()->danger($e->getMessage())->push();   
        }

    }

    public function render()
    {
        return view('livewire.admin.permission.create')->layout('layouts.admin-base');
    }
}
