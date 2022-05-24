<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $i = 1;
        return [
            'user_id' => $this->faker->numberBetween(1, 4),
            'major_id' => $this->faker->numberBetween(1, 5),
            'kelas_id' => $this->faker->numberBetween(1, 3),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'nis' => $this->faker->randomNumber(8),
            'no_hp' => $this->faker->phoneNumber(),
            'semester' => $this->faker->numberBetween(1, 2),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'foto' => $this->faker->imageUrl(400, 400, 'people'),
            'tanggal_lahir' => $this->faker->date(),

        ];
    }
}
