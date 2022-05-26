<?php

namespace Database\Seeders;

use App\Models\Departamentosede;
use Illuminate\Database\Seeder;

class DepartamentosedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamentosede::insert([
            'sede_id' => '1',
            'nombre_departamento' => 'ODON',
            
        ]);
        Departamentosede::insert([
            'sede_id' => '1',
            'nombre_departamento' => 'CIRU',
        ]);
    }
}
