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
            'nominal_pembayaran' => $this->faker->numberBetween(0, 1000000),
            'pembayaran_uts' => $this->faker->boolean,
            'pembayaran_uas' => $this->faker->boolean,
        ];
    }
}
