<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\BaseComponent;
use App\Models\Role;
use App\Models\Permission;
use AppHelper;

class Edit extends BaseComponent
{

    public $name, $role, $permissions = [], $selectedPermissions = [], $all;

    public function mount($id)
    {
        // AppHelper::hasPermissionTo('manage_employee');

        $this->role = Role::findOrFail($id);

        $this->fill([
            'name' => $this->role->name,
            'permissions' => Permission::all(),
            'selectedPermissions' => $this->role->permissions->pluck("id")->toArray(),
        ]);
    }

    public function updatedAll()
    {
        $this->selectedPermissions = collect($this->selectedPermissions)->count() > 0 ? [] : $this->permissions->pluck('id')->toArray();
    }


    public function submit()
    {

        $this->validate([
            'name' => 'required',
            'selectedPermissions' => 'array'
        ]);

        try {

            $this->role->update([
                'name' => $this->name
            ]);


            $this->role->syncPermissions($this->selectedPermissions);

            toast()->success('Role has been updated')->pushOnNextPage();

            redirect()->route("admin.role.list");
        } catch (\Exception $e) {
            toast()->danger($e->getMessage())->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.role.edit')->layout('layouts.admin-base');
    }
}
