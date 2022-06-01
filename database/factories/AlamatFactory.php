<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlamatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'siswa_id' => $this->faker->numberBetween(1, 4),
            'provinsi' => $this->faker->state,
            'kota' => $this->faker->city,
            'alamat' => $this->faker->address,
        ];
    }
}
