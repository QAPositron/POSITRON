<?php

namespace Database\Seeders;

use App\Models\Dosimetro;
use Illuminate\Database\Seeder;

class DosimetroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dosimetros_cuerpo_entero = [
            ['codigo_dosimeter' => 900050, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900051, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900052, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900053, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900054, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900055, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900056, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900057, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900058, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900059, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900060, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
        ];
        Dosimetro::insert($dosimetros_cuerpo_entero);

        $dosimetros_ezclip=[
            ['codigo_dosimeter' => 900061, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900062, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900063, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900064, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900065, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900066, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900067, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900068, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900069, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900070, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
        ];

        Dosimetro::insert($dosimetros_ezclip);

        $dosimetros_control=[
            ['codigo_dosimeter' => 900071, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900072, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900073, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900074, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900075, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900076, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900077, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900078, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900079, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900080, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
        ];

        Dosimetro::insert($dosimetros_control);
    }
}
