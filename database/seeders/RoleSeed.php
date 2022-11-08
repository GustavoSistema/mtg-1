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
        /* Creando Roles*/
        $admin=Role::create(['name'=>'administrador']);
        $inspector=Role::create(['name'=>'inspector']);

        Permission::create(['name'=>'expedientes'])->syncRoles($admin);
        Permission::create(['name'=>'expedientes'])->syncRoles($inspector);

    }
}
