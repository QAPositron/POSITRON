<?php

namespace Database\Seeders;

use App\Models\Coldepartamento;
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
    }
}
