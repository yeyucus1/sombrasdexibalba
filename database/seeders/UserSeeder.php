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
            'name' => 'Nahúm',
            'lastname' => 'Ramírez',
            'pseudonym' => 'Ethan Morgue',
            'password' => bcrypt('tÑelJOsYja6cQrKaHd'),
            'email' => 'admin@tecnowizards.com',
            'user_type_id' => UserType::where('name', 'Administrador')-> first()->id
        ]);
    }
}
