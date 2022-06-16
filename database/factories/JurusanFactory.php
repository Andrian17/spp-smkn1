<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JurusanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jurusan = [
            'Teknik Komputer Jaringan',
            'Keuangan Syariah',
            'Administrasi Perkantoran',
            'Tata Niaga',
            'Usaha Perjalanan Pariwisata',
        ];
        return [
            'jurusan' => $jurusan[array_rand($jurusan)],
        ];
    }
}
