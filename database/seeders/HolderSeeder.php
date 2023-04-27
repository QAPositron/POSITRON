<?php

namespace Database\Seeders;

use App\Models\Holder;
use Illuminate\Database\Seeder;

class HolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $holder_anillo=[
            ['codigo_holder' => 800050, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800051, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800052, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800053, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800054, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800055, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800056, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800057, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800058, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800059, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800060, 'tipo_holder' => 'ANILLO', 'estado_holder' => 'STOCK'],
        ];
        Holder::insert($holder_anillo);

        $holder_extremidad=[
            ['codigo_holder' => 800061, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800062, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800063, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800064, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800065, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800066, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800067, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800068, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800069, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800070, 'tipo_holder' => 'EXTREM', 'estado_holder' => 'STOCK'],
        ];
        Holder::insert($holder_extremidad);

        $holder_cristalino=[
            ['codigo_holder' => 800071, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800072, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800073, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800074, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800075, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800076, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800077, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800078, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800079, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
            ['codigo_holder' => 800080, 'tipo_holder' => 'CRISTALINO', 'estado_holder' => 'STOCK'],
        ];

        Holder::insert($holder_cristalino);
    }
}
