<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Http\Livewire\BaseComponent;
use App\Repositories\EmployeeRepository;
use App\Models\Role;
use App\Models\User;
use AppHelper;

class Edit extends BaseComponent
{

    public $first_name, $last_name, $email, $role_id, $roles;
    public $password, $password_confirmation, $user, $mobile_number;

    public function mount($id)
    {

        AppHelper::hasPermissionTo('manage_employee');

        $this->user = User::findOrFail($id);

        $this->fill([
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'mobile_number' => $this->user->mobile_number,
            'email' => $this->user->email,
            'role_id' => $this->user->roles[0]->id ?? 0,
            'roles' => Role::all()
        ]);
    }


    public function submit()
    {

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'password' => 'nullable|confirmed|min:6|alpha_num',
            'role_id' => 'required',
            'email' => 'required|unique:users,email,' . $this->user->id,
        ]);


        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile_number' => $this->mobile_number,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id
        ];

        try {

            throw_unless(EmployeeRepository::updateEmployee($this->user->id, $data), "Failed to update Employee");

            toast()->success('Employee Information updated')->pushOnNextPage();

            return redirect()->route("admin.employee.list");
        } catch (\Exception $e) {

            return toast()->danger($e->getMessage())->push();
        }
    }


    public function render()
    {
        return view('livewire.admin.employee.edit')->layout('layouts.admin-base');
    }
}
