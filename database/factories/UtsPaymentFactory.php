<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UtsPaymentFactory extends Factory
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
            'nominal_pembayaran' => 240000,
            'order_id' => 'spp-' . uniqid(),
        ];
    }
}
