<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
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
            'order_id' => 'spp-' . uniqid(),
            'nominal_pembayaran' => 240000,
            'jenis_pembayaran' => $this->faker->randomElement(['mid-semester', 'akhir-semester']),
        ];
    }
}
