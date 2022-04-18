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
            ['codigo_dosimeter' => 200021137, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022027, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200020104, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022459, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021671, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021193, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            /*['codigo_dosimeter' => 900056, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900057, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900058, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900059, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900060, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CUERPO E.', 'fecha_ingreso_servicio'=>'2022-03-18'], */
        ];
        Dosimetro::insert($dosimetros_cuerpo_entero);

        $dosimetros_ezclip=[
            ['codigo_dosimeter' => 86651, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18652, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17933, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17765, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17574, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18489, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17164, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18472, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            /* ['codigo_dosimeter' => 900069, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900070, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'fecha_ingreso_servicio'=>'2022-03-18'], */
        ];

        Dosimetro::insert($dosimetros_ezclip);

        $dosimetros_control=[
           
            ['codigo_dosimeter' => 200020468, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022899, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            /* ['codigo_dosimeter' => 900073, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900074, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900075, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900076, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900077, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900078, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900079, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 900080, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'CONTROL', 'fecha_ingreso_servicio'=>'2022-03-18'], */
        ];

        Dosimetro::insert($dosimetros_control);
    }
}
