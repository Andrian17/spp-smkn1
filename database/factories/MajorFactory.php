<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MajorFactory extends Factory
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
            'Usaha Perjalanan Wisata',
        ];
        return [
            'jurusan' => $jurusan[array_rand($jurusan)],
        ];
    }
}
