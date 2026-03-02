<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
             UserTypeSeeder::class,
        UserSeeder::class,      //  PRIMERO crear usuarios
        HousesSeeder::class,    //  Luego crear casas
        TypesSeeder::class,
        MembersSeeder::class,
        LocationsSeeder::class,
        GeneresSeeder::class,
        ArtworksSeeder::class,
        CharactersSeeder::class,
        CommentsSeeder::class,
        FollowersSeeder::class,
        RatingsSeeder::class,
        ]);
    }
}
