<?php

namespace Database\Seeders;

use App\Models\Areadepartamentosede;
use App\Models\Coldepartamento;
use App\Models\Departamentosede;
use App\Models\Personasroles;
use App\Models\Trabajador;
use App\Models\Trabajadorsede;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ColdepartamentoSeeder::class);
        $this->call(ColmunicipioSeeder::class);
        $this->call(DosimetroSeeder::class);
        $this->call(HolderSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(SedeSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(DepartamentosedeSeeder::class);
        $this->call(AreadepartamentosedeSeeder::class);
        /* $this->call(RolSeeder::class); */
        $this->call(PerfilSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(PersonasedesSeeder::class);
        /* $this->call(PersonasrolesSeeder::class); */
        $this->call(ObservacionesSeeder::class);


        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(PersonasrolesSeeder::class);

    }
}
