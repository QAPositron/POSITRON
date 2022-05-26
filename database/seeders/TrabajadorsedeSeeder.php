<?php

namespace Database\Seeders;

use App\Models\Trabajadorsede;
use Illuminate\Database\Seeder;

class TrabajadorsedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trabajadorsede::insert([
            'trabajador_id' => '1',
            'sede_id'       => '1',
        ]);
        Trabajadorsede::insert([
            'trabajador_id' => '2',
            'sede_id'       => '1',
        ]);
        Trabajadorsede::insert([
            'trabajador_id' => '3',
            'sede_id'       => '1',
        ]);
        Trabajadorsede::insert([
            'trabajador_id' => '4',
            'sede_id'       => '1',
        ]);
        Trabajadorsede::insert([
            'trabajador_id' => '5',
            'sede_id'       => '1',
        ]);
        Trabajadorsede::insert([
            'trabajador_id' => '6',
            'sede_id'       => '1',
        ]);
        Trabajadorsede::insert([
            'trabajador_id' => '7',
            'sede_id'       => '1',
        ]);
    }
}
