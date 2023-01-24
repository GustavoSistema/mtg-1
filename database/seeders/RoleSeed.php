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

        //Permission::find(4)->syncRoles([$supervisor,$admin,$inspector]);
       // Permission::find(5)->syncRoles([$supervisor,$admin]);       
       
       $ingresos=Permission::create(["name"=>"ingresos"]);
       $salidas=Permission::create(["name"=>"salidas"]);
       $asignacion=Permission::create(["name"=>"asignacion"]);


       $ingresos->syncRoles([$admin]);
       $salidas->syncRoles([$admin]);
       $asignacion->syncRoles([$admin]);



       $inventario=Permission::create(["name"=>"inventario"]);
       $servicio=Permission::create(["name"=>"servicio"]);
       $recepcion=Permission::create(["name"=>"recepcion"]);       
       $solicitudes=Permission::create(["name"=>"solicitud"]);
       $nuevaSoli=Permission::create(["name"=>"nuevaSolicitud"]);


       $inventario->syncRoles([$supervisor,$inspector]);
       $servicio->syncRoles([$supervisor,$inspector]);
       $recepcion->syncRoles([$supervisor,$inspector]);
       $solicitudes->syncRoles([$supervisor,$inspector]);
       $nuevaSoli->syncRoles([$supervisor,$inspector]);

    }
}
