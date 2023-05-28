<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\UasPayment;
use App\Models\User;
use App\Models\UtsPayment;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();
        $users->each(function ($user) {
            Siswa::factory(1)->create([
                "user_id" => $user->id
            ]);
            UtsPayment::factory(1)->create([
                "siswa_id" => $user->id
            ]);
            UasPayment::factory(1)->create([
                "siswa_id" => $user->id
            ]);
            Alamat::factory(1)->create([
                "siswa_id" => $user->id
            ]);
        });
    }
}
