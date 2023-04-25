<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $departamentos = [
            ['nombre_departamento' => 'TELETERAPIA'],
            ['nombre_departamento' => 'BRAQUITERAPIA'],
            ['nombre_departamento' => 'MEDICINA NUCLEAR'],
            ['nombre_departamento' => 'GAMMAGRAFÍA INDUSTRIAL'],
            ['nombre_departamento' => 'MEDIDORES FIJOS'],
            ['nombre_departamento' => 'INVESTIGACIÓN'],
            ['nombre_departamento' => 'DENSÍMETRO NUCLEAR'],
            ['nombre_departamento' => 'MEDIDORES MÓVILES'],
            ['nombre_departamento' => 'DOCENCIA'],
            ['nombre_departamento' => 'PERFILAJE Y REGISTRO'],
            ['nombre_departamento' => 'TRAZADORES'],
            ['nombre_departamento' => 'HEMODINAMIA'],
            ['nombre_departamento' => 'ODONTOLOGÍA'],
            ['nombre_departamento' => 'RADIODIAGNÓSTICO'],
            ['nombre_departamento' => 'FLUOROSCOPIA'],
            ['nombre_departamento' => 'CIRUGÍA']
        ];
        Departamento::insert($departamentos);
    }
}
