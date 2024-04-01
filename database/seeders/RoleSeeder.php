<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'superAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'liderDosim']);
        $role4 = Role::create(['name' => 'ESTUDIANTE']);
        $role5 = Role::create(['name' => 'CONTACTO']);
        $role6 = Role::create(['name' => 'TOE']);
        $role7 = Role::create(['name' => 'OPR']);
        $role8 = Role::create(['name' => 'PUBLICO']);
        
        Permission::create(['name' =>'liderdosim.home'])->assignRole($role3);
        //// para asignar un rol este permiso pero si se quiere asignar mas de un rol se usa ->syncRoles([])

        
    }
}