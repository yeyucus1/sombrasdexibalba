<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserTypeSeeder::class,
            HousesSeeder::class,
            TypesSeeder::class,
            MembersSeeder::class,
            LocationsSeeder::class,
            GenresSeeder::class,
            UserSeeder::class,
            ArtworksSeeder::class,
            CharactersSeeder::class,
            CommentsSeeder::class,
            FollowersSeeder::class,
            RatingsSeeder::class,
        ]);
    }
}
