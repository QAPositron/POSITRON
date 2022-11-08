<?php

namespace Database\Seeders;

use App\Models\Perfiles;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $perfiles = [
            ['nombre_perfil' => 'GERENCIA'],
            ['nombre_perfil' => 'SUBGERENCIA'],
            ['nombre_perfil' => 'BIOMÉDICA'],
            ['nombre_perfil' => 'FÍSICA MÉDICA'],
            ['nombre_perfil' => 'TECNÓLOGO'],
            ['nombre_perfil' => 'ENFERMERA'],
            ['nombre_perfil' => 'AUXILIAR DE ENFERMERIA'],
            ['nombre_perfil' => 'CALIDAD'],
            ['nombre_perfil' => 'CONTABILIDAD'],
            ['nombre_perfil' => 'SEGURIDAD Y SALUD EN EL TRABAJO'],

        ];
        Perfiles::insert($perfiles);
    }
}
