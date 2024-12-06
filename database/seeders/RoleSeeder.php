<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     
    public function run()
    {
        // Role::create(['name' => 'Super Admin']);
        // Role::create(['name' => 'normal']);
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
         DB::table('roles')->truncate();
         $file_path = database_path('roles.sql');
         DB::unprepared(file_get_contents($file_path));

    }
}
