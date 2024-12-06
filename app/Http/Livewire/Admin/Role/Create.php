<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\BaseComponent;
use App\Models\Role;
use App\Models\Permission;
use AppHelper;

class Create extends BaseComponent
{

    public $name, $permissions = [], $selectedPermissions = [], $all;

    public function mount(){
        // AppHelper::hasPermissionTo('manage_employee');
        $this->permissions = Permission::all();
    }

    public function updatedAll(){
        $this->selectedPermissions = collect($this->selectedPermissions)->count() > 0 ? [] : $this->permissions->pluck('id')->toArray();
    }

    public function submit(){
        $this->validate([
            'name' => 'required',
            'selectedPermissions' => 'array'
        ]);

        try {
            $role = Role::create([
               'name' => $this->name 
            ]);

             $role->syncPermissions($this->selectedPermissions);

            toast()->success('Role has been created')->pushOnNextPage();
            
            redirect()->route("admin.role.list");

        } catch (\Exception $e) {
            toast()->danger($e->getMessage())->push();   
        }


    }


    public function render()
    {
        return view('livewire.admin.role.create')->layout('layouts.admin-base');
    }
}
