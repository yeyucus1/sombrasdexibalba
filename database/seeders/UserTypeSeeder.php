<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::insert([
            'name' => 'Administrador',
        ]);
        //V3
        /*UserType::insert([
            'name' => 'Reader',
        ]);*/

        UserType::insert([
            'name' => 'Writer',
        ]);
    }
}
