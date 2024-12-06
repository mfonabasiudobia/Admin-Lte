<?php

namespace App\Http\Livewire\Admin\Permission;

use App\Http\Livewire\BaseComponent;
use App\Models\Permission;
use AppHelper;

class Edit extends BaseComponent
{

    public $name, $permission;

    public function mount($id){
        // AppHelper::hasPermissionTo('manage_employee');

        $this->permission = Permission::findOrFail($id);

        $this->fill([
            'name' => $this->permission->name
        ]);
    }

    public function submit(){
    
        $this->validate([
            'name' => 'required'
        ]);

        try {
            
            $this->permission->update([
               'name' => $this->name 
            ]);

            toast()->success('Permission has been updated')->pushOnNextPage();
            
            redirect()->route("admin.permission.list");

        } catch (\Exception $e) {
           toast()->danger($e->getMessage())->push();   
        }

    }

    public function render()
    {
        return view('livewire.admin.permission.edit')->layout('layouts.admin-base');
    }
}
