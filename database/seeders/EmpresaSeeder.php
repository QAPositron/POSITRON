<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::insert([
            'nombre_empresa'              => 'SANITAS',
            'num_iden_empresa'            => '1098799034',
            'DV'                          => '0',
            'telefono_empresa'            => '123456789',
            'email_empresa'               => 'SAN@GMAIL.COM',
            'direccion_empresa'           => 'CALLE 123',
            'primer_nombre_representantelegal' =>'DEISY',
            'segundo_nombre_representantelegal'=>'KATHERINE',
            'primer_apellido_representantelegal'=>'RANGEL',
            'segundo_apellido_representantelegal'=>'FLOREZ',
            'cedula_representantelegal'   => '1098799034',
            'municipiocol_id'             => '1',
            'pais_empresa'                => 'COLOMBIA',
            'tipo_empresa'                => 'PERSONA JURIDICA',
            'tipo_identificacion_empresa' => 'NIT',
            'actividad_economica_empresa' => '1111',
            'respo_iva_empresa'           => 'NO RESPONSABLE DE IVA',
            'respo_fiscal_empresa'        => 'NO RESPONSABLE (R-99-PN)',
        ]);
        Empresa::insert([
            'nombre_empresa'              => 'SALUDCOOP',
            'num_iden_empresa'            => '1098799035',
            'DV'                          => '0',
            'telefono_empresa'            => '98764321',
            'email_empresa'               => 'SALUD@GMAIL.COM',
            'direccion_empresa'           => 'CALLE 321',
            'primer_nombre_representantelegal' =>'GLADYS',
            'segundo_nombre_representantelegal'=>'',
            'primer_apellido_representantelegal'=>'FLOREZ',
            'segundo_apellido_representantelegal'=>'RODRIGUEZ',
            'cedula_representantelegal'   => '60254075',
            'municipiocol_id'             => '50',
            'pais_empresa'                => 'COLOMBIA',
            'tipo_empresa'                => 'PERSONA JURIDICA',
            'tipo_identificacion_empresa' => 'NIT',
            'actividad_economica_empresa' => '1111',
            'respo_iva_empresa'           => 'NO RESPONSABLE DE IVA',
            'respo_fiscal_empresa'        => 'NO RESPONSABLE (R-99-PN)',
        ]);
    }
}
