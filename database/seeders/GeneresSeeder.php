<?php

namespace Database\Seeders;

use App\Models\generes;
use Illuminate\Database\Seeder;

class GeneresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        generes::insert([
            'name' => 'Terror',
            'description' => 'Obra de miedo, pero con implicaciones reales (personas, animales, etc.)',
        ]);

        generes::insert([
            'name' => 'Horror',
            'description' => 'Obra de miedo, pero con implicaciones paranormales (fantasmas, magia, criptidos, etc.)',
        ]);

        generes::insert([
            'name' => 'Misterio',
            'description' => 'Obra de misterio',
        ]);

        generes::insert([
            'name' => 'Amor',
            'description' => 'Obra de amor, sin implicaciones eroricas',
        ]);

        generes::insert([
            'name' => 'Ciencia Ficción',
            'description' => 'Obra de ciencia ficción',
        ]);

        generes::insert([
            'name' => 'Historia real',
            'description' => 'Historia basada en hechos reales',
        ]);

    }
}
