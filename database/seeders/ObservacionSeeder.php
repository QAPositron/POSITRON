<?php

namespace Database\Seeders;

use App\Models\Observacion;
use Illuminate\Database\Seeder;

class ObservacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $observaciones = [
            ['obs' => 'BUEN ESTADO FÍSICO'],
            ['obs' => 'DOSÍMETRO CONTAMINADO'],
            ['obs' => 'DOSÍMETRO FALTANTE'],
            ['obs' => 'DOSÍMETRO DAÑADO'],
            ['obs' => 'DOSÍMETRO HUMEDO'],
            ['obs' => 'DOSÍMETRO DE OTRO PERIODO'],
            ['obs' => 'DOSÍMETRO DE OTRA SEDE'],
            ['obs' => 'HOLDER DAÑADO'],
            ['obs' => 'OTRA ADICIONAL'],

        ];
        Observacion::insert($observaciones);
    }
}
