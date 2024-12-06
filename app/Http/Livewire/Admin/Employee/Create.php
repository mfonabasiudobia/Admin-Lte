<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Http\Livewire\BaseComponent;
use App\Repositories\EmployeeRepository;
use App\Models\Role;
use AppHelper;

class Create extends BaseComponent
{
    public $first_name, $last_name, $email, $mobile_number, $role_id, $password, $password_confirmation, $roles;

    public function mount()
    {

        AppHelper::hasPermissionTo('manage_employee');

        $this->fill([
            'roles' => Role::all()
        ]);
    }

    public function submit()
    {

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6|alpha_num',
            'role_id' => 'required'
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

            throw_unless(EmployeeRepository::createEmployee($data), "Failed to create Employee");

            toast()->success('Employee has been created')->pushOnNextPage();

            return redirect()->route("admin.employee.list");
        } catch (\Exception $e) {

            return toast()->danger($e->getMessage())->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.employee.create')->layout('layouts.admin-base');
    }
}
