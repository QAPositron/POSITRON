<?php

namespace Database\Seeders;

use App\Models\Personasedes;
use Illuminate\Database\Seeder;

class PersonasedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Personasedes::insert([

            'persona_id' => '1',
            'sede_id' => '2',
            
        ]);
        Personasedes::insert([

            'persona_id' => '2',
            'sede_id' => '2',
            
        ]);
    }
}
