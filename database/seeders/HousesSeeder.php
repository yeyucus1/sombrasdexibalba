<?php

namespace Database\Seeders;

use App\Models\houses;
use App\Models\User;
use Illuminate\Database\Seeder;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        houses::insert([
            'name' => 'Casa Publica',
            'description' => 'Casa de todos los usuarios',
            'founder' => User::first()->id
        ]);

    }
}
