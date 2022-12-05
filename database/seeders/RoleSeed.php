<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Creando Roles
        $admin=Role::create(['name'=>'administrador']);
        $inspector=Role::create(['name'=>'inspector']);
        */
        $admin=Role::find(5);
        $inspector=Role::find(6);
        $supervisor=Role::find(7);

        Permission::find(4)->syncRoles([$supervisor,$admin,$inspector]);
        Permission::find(5)->syncRoles([$supervisor,$admin]);                

    }
}
