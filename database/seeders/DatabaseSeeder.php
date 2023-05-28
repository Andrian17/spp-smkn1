<?php

namespace Database\Seeders;

use App\Models\Kelas;
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
        // \App\Models\User::factory(1)->create();
        // $this->call(UserSeeder::class);
        // $this->call(KelasSeeder::class);
        $this->call(JurusanSeeder::class);
    }
}
