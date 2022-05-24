<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kelas' => $this->faker->numberBetween(1, 3),
            'tahun_ajaran' => $this->faker->year,
        ];
    }
}
