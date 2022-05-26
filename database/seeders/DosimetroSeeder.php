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
        $dosimetros_general = [
            ['codigo_dosimeter' => 200021193, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200020104, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022459, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021671, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200020468, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022899, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021137, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022027, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021191, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200020102, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022453, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021674, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200020465, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022896, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021138, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022029, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'GENERAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
        ];
        Dosimetro::insert($dosimetros_general);

        $dosimetros_ambiental = [
            ['codigo_dosimeter' => 200020, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200021, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200022, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200023, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200024, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200025, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200026, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200027, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200028, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200029, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200030, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200031, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200032, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200033, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200034, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 200035, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro'=>'AMBIENTAL', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
        ];
        Dosimetro::insert($dosimetros_ambiental);

        $dosimetros_ezclip=[
            ['codigo_dosimeter' => 18665, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18652, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17933, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17765, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17574, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18489, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17164, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18472, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18661, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18653, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17932, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17764, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17575, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18486, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 17167, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
            ['codigo_dosimeter' => 18478, 'estado_dosimetro' => 'STOCK', 'tecnologia_dosimetro' => 'OSL', 'tipo_dosimetro' =>'EZCLIP', 'uso_dosimetro' =>'', 'fecha_ingreso_servicio'=>'2022-03-18'],
        ];
        Dosimetro::insert($dosimetros_ezclip);

        
    }
}
