<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sede::insert([

            'empresas_id' => '1',
            'nombre_sede' => 'CENTRAL',
            'municipiocol_id' => '1',
            'direccion_sede' => 'CALLE 300'
        ]);
            
    }
}
