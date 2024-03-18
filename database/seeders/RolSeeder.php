<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
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

        Permission::create(['name' =>'liderdosim.home'])->assignRole($role3);
        //// para asignar un rol este permiso pero si se quiere asignar mas de un rol se usa ->syncRoles([])

        
    }
}
