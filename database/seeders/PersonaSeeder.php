<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Persona::insert([

            'primer_nombre_persona' => 'GLADYS',
            'segundo_nombre_persona' => '',
            'primer_apellido_persona' => 'FLOREZ',
            'segundo_apellido_persona' => 'RODRIGUEZ',
            'genero_persona' => 'FEMENINO',
            'tipo_iden_persona' => 'CÉDULA DE CIUDADANIA',
            'cedula_persona' => '60254072',
            'correo_persona' => 'G@GMAIL.COM',
            'telefono_persona'=>'1234567899',
            'estado_persona' =>'ACTIVO',
            'lider_ava' => '',
            'lider_dosimetria'=> '',
            'lider_controlescalidad'=> ''
        ]);
        Persona::insert([

            'primer_nombre_persona' => 'YELI',
            'segundo_nombre_persona' => '',
            'primer_apellido_persona' => 'RANGEL',
            'segundo_apellido_persona' => 'FLOREZ',
            'genero_persona' => 'FEMENINO',
            'tipo_iden_persona' => 'CÉDULA DE CIUDADANIA',
            'cedula_persona' => '1098799000',
            'correo_persona' => 'y@GMAIL.COM',
            'telefono_persona'=>'1234567899',
            'estado_persona' =>'ACTIVO',
            'lider_ava' => '',
            'lider_dosimetria'=> '',
            'lider_controlescalidad'=> ''
        ]);
    }
}
