<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use AppHelper;

class EmployeeRepository
{



    public static function createEmployee($data): User
    {
        $user = User::create([
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "mobile_number" => $data['mobile_number'],
            "email" => $data['email'],
            "password" => bcrypt($data['password'])
        ]);

        $role = Role::find($data['role_id']);

        $user->assignRole($role->name);

        return $user;
    }


    public static function updateEmployee(string $id, $data): User

    {
        $user = User::findOrFail($id);

        $user->update([
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "mobile_number" => $data['mobile_number'],
            "email" => $data['email'],
            "password" => $data['password'] ? bcrypt($data['password']) : $user->password
        ]);

        $role = Role::find($data['role_id']);

        // $user->syncRoles([$role->name]);

        // $user->roles()->detach(); // Remove any existing roles

        $user->syncRoles([]);
        $user->assignRole($role->name); // Assign the new role


        return $user;
    }
}
