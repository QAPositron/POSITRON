<?php

namespace Database\Seeders;

use App\Models\Areadepartamentosede;
use Illuminate\Database\Seeder;

class AreadepartamentosedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Areadepartamentosede::insert([
            'departamentosede_id' => '1',
            'nombre_area' => 'AREA 1',
            'descripcion' => 'PRIMER AREA', 
        ]);
        Areadepartamentosede::insert([
            'departamentosede_id' => '1',
            'nombre_area' => 'AREA 2',
            'descripcion' => 'SEGUNDA AREA', 
        ]);
        Areadepartamentosede::insert([
            'departamentosede_id' => '1',
            'nombre_area' => 'AREA 3',
            'descripcion' => 'TERCER AREA', 
        ]);
    }
}
