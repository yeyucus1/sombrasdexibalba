<?php

namespace Database\Seeders;

use App\Models\types;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        types::insert([
            'name' => 'Cuento Corto',
            'description' => 'Cuento'
        ]);

        types::insert([
            'name' => 'Poema en verso',
            'description' => 'Poema'
        ]);

        types::insert([
            'name' => 'Poema en prosa',
            'description' => 'Poema en prosa'
        ]);

    }
}
