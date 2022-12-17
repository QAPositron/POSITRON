<?php

namespace Database\Seeders;

use App\Models\Personasroles;
use Illuminate\Database\Seeder;

class PersonasrolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Personasroles::insert([

            'persona_id' => '1',
            'rol_id' => '3',
            
        ]);
        Personasroles::insert([

            'persona_id' => '2',
            'rol_id' => '3',
            
        ]);
    }
}
