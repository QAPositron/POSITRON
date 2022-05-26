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
            'municipiocol_id'             => '1',
            'pais_empresa'                => 'COLOMBIA',
            'tipo_empresa'                => 'PERSONA JURIDICA',
            'tipo_identificacion_empresa' => 'NIT',
            'actividad_economica_empresa' => '1111',
            'respo_iva_empresa'           => 'NO RESPONSABLE DE IVA',
            'respo_fiscal_empresa'        => 'NO RESPONSABLE (R-99-PN)',
        ]);
    }
}
