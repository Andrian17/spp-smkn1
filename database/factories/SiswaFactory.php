<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 4),
            'jurusan_id' => $this->faker->numberBetween(1, 5),
            'kelas_id' => $this->faker->numberBetween(1, 3),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'nis' => $this->faker->randomNumber(8),
            'no_hp' => $this->faker->phoneNumber(),
            'semester' => $this->faker->numberBetween(1, 2),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'angkatan' => $this->faker->year(),
            'tanggal_lahir' => $this->faker->date(),
        ];
    }
}
