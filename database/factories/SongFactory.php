<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(4, true),
            'artist' => $this->faker->name(),
            'genre' => $this->faker->word(),
            'duration' => $this->faker->numberBetween(0, 120),
            'year' => $this->faker->year(),
        ];
    }
}
