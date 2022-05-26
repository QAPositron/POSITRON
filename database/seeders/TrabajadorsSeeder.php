<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Seeder;

class TrabajadorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'ANDRES',
            'segundo_nombre_trabajador'   => 'JAVIER',
            'primer_apellido_trabajador'  => 'CUADROS',
            'segundo_apellido_trabajador' => 'SANABRIA',
            'cedula_trabajador'           => '1098799445',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'M',
            'email_trabajador'            => 'ANDS@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'DEISY',
            'segundo_nombre_trabajador'   => 'KATHERINE',
            'primer_apellido_trabajador'  => 'RANGEL',
            'segundo_apellido_trabajador' => 'FLOREZ',
            'cedula_trabajador'           => '1098799034',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'F',
            'email_trabajador'            => 'D@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'YELI',
            'segundo_nombre_trabajador'   => '',
            'primer_apellido_trabajador'  => 'RANGEL',
            'segundo_apellido_trabajador' => 'FLOREZ',
            'cedula_trabajador'           => '1098741236',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'F',
            'email_trabajador'            => 'Y@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'BELCY',
            'segundo_nombre_trabajador'   => '',
            'primer_apellido_trabajador'  => 'FLOREZ',
            'segundo_apellido_trabajador' => 'RODRIGUEZ',
            'cedula_trabajador'           => '60254123',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'F',
            'email_trabajador'            => 'B@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
        
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'GLADYS',
            'segundo_nombre_trabajador'   => '',
            'primer_apellido_trabajador'  => 'FLOREZ',
            'segundo_apellido_trabajador' => 'RODRIGUEZ',
            'cedula_trabajador'           => '60254072',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'F',
            'email_trabajador'            => 'G@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'ALIRIO',
            'segundo_nombre_trabajador'   => '',
            'primer_apellido_trabajador'  => 'RANGEL',
            'segundo_apellido_trabajador' => 'VERA',
            'cedula_trabajador'           => '13350195',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'M',
            'email_trabajador'            => 'A@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
        Trabajador::insert([
            'empresa_id'                  => '1',
            'primer_nombre_trabajador'    => 'JAVIER',
            'segundo_nombre_trabajador'   => '',
            'primer_apellido_trabajador'  => 'CUADROS',
            'segundo_apellido_trabajador' => 'FLOREZ',
            'cedula_trabajador'           => '13350199',
            'tipo_iden_trabajador'        => 'CÉDULA DE CIUDADANIA',
            'genero_trabajador'           => 'M',
            'email_trabajador'            => 'J@GMAIL.COM',
            'telefono_trabajador'         => '123456789',
            'tipo_trabajador'             => 'TOE',
            
        ]);
    }
}
