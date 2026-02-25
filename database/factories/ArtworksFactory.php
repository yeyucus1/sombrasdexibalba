<?php

namespace Database\Factories;

use App\Models\Artworks;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtworksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artworks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            // ejemplo de campos comunes
            'title'       => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'content'     => $this->faker->text(1500),
            'rating'      => $this->faker->numberBetween(1, 5),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
