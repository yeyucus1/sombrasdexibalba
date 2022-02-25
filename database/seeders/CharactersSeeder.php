<?php

namespace Database\Seeders;

use App\Models\characters;
use Illuminate\Database\Seeder;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        characters::insert([
            'name' => 'generico',
            'lastname' => 'Masculino',
            'age' => '19',
            'description' => 'descripción generica',
            'Family' => 'Generica',
            'family_description' => 'generica',
            'native_city' => 'cualquiera',
            'living_city' => 'cualquiera',
        ]);
        characters::insert([
            'name' => 'generico',
            'lastname' => 'Femenino',
            'age' => '19',
            'description' => 'descripción generica',
            'Family' => 'Generica',
            'family_description' => 'generica',
            'native_city' => 'cualquiera',
            'living_city' => 'cualquiera',
        ]);


    }
}
