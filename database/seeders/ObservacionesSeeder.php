<?php

namespace Database\Seeders;

use App\Models\Observacion;
use Illuminate\Database\Seeder;

class ObservacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $obs = [
            ['obs' => 'BUEN ESTADO FÍSICO'],
            ['obs' => 'DOSÍMETRO CONTAMINADO'],
            ['obs' => 'DOSÍMETRO FALTANTE'],
            ['obs' => 'DOSÍMETRO DAÑADO'],
            ['obs' => 'DOSÍMETRO HUMEDO'],
            ['obs' => 'DOSÍMETRO DE OTRO PERIODO'],
            ['obs' => 'DOSÍMETRO DE OTRA SEDE'],
            ['obs' => 'HOLDER DAÑADO'],
            ['obs' => 'OTRA ADICIONAL'],
            ['obs' => 'HOLDER SUCIO']
        ];
        Observacion::insert($obs);
    }
    
}
