<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseComponent;
use App\Repositories\EmployeeRepository;
use Spatie\Permission\Models\Role;

class Create extends BaseComponent
{
    public $name, $email, $role_id, $password, $password_confirmation, $userTypes;

    public function mount()
    {
        $this->fill([
            'userTypes' => Role::all()
        ]);
    }

    public function submit(EmployeeRepository $userRepo)
    {

        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required|confirmed|min:6|alpha_num',
            'role_id' => 'required'
        ]);


        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id
        ];

        try {

            throw_unless($userRepo->createEmployee((object) $data), "Failed to create Employee");

            toast()->success('Employee has been created')->pushOnNextPage();

            return redirect()->route("admin.employee.list");
        } catch (\Exception $e) {

            return toast()->danger($e->getMessage())->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.user.create')->layout('layouts.admin-base');
    }
}
