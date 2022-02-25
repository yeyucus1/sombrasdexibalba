<?php

namespace Database\Seeders;

use App\Models\locations;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        locations::insert([
            'name' => 'escenario generico',
            'fundation' => Carbon::now()->format('Y-m-d'),
            'description' => 'Escenario genérico si no quieres crear uno',
            'creator' =>User::first()->id
        ]);


    }
}
