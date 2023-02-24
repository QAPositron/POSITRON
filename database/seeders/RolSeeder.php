<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            ['nombre_rol' => 'ESTUDIANTE'],
            ['nombre_rol' => 'CONTACTO'],
            ['nombre_rol' => 'TOE'],
            ['nombre_rol' => 'OPR'],
            ['nombre_rol' => 'PUBLICO'],
        ];
        Roles::insert($roles);
    }
}
