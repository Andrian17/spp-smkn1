<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(21)->create();
        \App\Models\Siswa::factory(20)->create();
        \App\Models\Kelas::factory(3)->create();
        \App\Models\Jurusan::factory(5)->create();
        \App\Models\Payment::factory(20)->create();
        \App\Models\Alamat::factory(20)->create();
        \App\Models\UasPayment::factory(20)->create();
        \App\Models\UtsPayment::factory(20)->create();
    }
}
