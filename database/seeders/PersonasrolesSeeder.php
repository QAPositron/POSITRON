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
            'role_id' => '3',
            
        ]);
        Personasroles::insert([

            'persona_id' => '2',
            'role_id' => '3',
            
        ]);
    }
}
