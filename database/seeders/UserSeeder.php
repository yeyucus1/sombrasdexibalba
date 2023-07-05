<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            'name' => 'Usuario',
            'lastname' => 'Prueba',
            'pseudonym' => 'Usuario Prueba 1',
            'password' => bcrypt('tÑelJOsYja6cQrKaHd'),
            'email' => 'admin@tecnowizards.com',
            'user_type_id' => UserType::where('name', 'Administrador')-> first()->id
        ]);

    }
}
