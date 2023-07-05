<?php

namespace Database\Seeders;

use App\Models\houses;
use App\Models\members;
use App\Models\User;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        members::insert([

            'house' => houses::first()->id,
            'user' => User::first()->id

        ]);
    }
}
