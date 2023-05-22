<?php

namespace App\Services;

use App\Models\Alamat;
use App\Models\Siswa;
use App\Models\UasPayment;
use App\Models\User;
use App\Models\UtsPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService
{

    public function adminInputValidate(Request $request, $forUserSave = false, $forSiswaSave = false)
    {
        $adminInputValidate = $request->validate([
            'email' => $forUserSave ? 'required|email|unique:users' : 'required',
            'nama' => 'required',
            'nis' => $forSiswaSave ? 'required|unique:siswas' : 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'semester' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'angkatan' => 'required|numeric',
            "alamat" => "required"
        ]);
        return $adminInputValidate;
    }

    public function userSave(Request $request)
    {
        $userValidate = $this->adminInputValidate($request, true);
        $userValidate['password'] = Hash::make($request->input("nis"));
        $userValidate["name"] = $request->input("nama");
        try {
            $saveUser = User::create($userValidate);
            return $saveUser;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function siswaSave(Request $request, $userId)
    {
        $siswaValidate = $this->adminInputValidate($request, false, true);
        $siswaValidate["user_id"] = $userId;
        try {
            $siswa = Siswa::create($siswaValidate);
            return $siswa;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function alamatSave(Request $request, $siswaId)
    {
        $alamatValidated = $this->adminInputValidate($request);
        $alamatValidated["siswa_id"] = $siswaId;
        try {
            $alamat = Alamat::create($alamatValidated);
            return $alamat;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function createPayments($siswa_id)
    {
        $siswa = $siswa_id;
        try {
            // Create UTS Payment
            UtsPayment::create([
                'siswa_id' => $siswa,
                'order_id' => 'spp-' . uniqid(),
                'nominal_pembayaran' => 240000,
                'jenis_pembayaran' => 'mid-semester',
            ]);
            // Create UAS Payment
            UasPayment::create([
                'siswa_id' => $siswa,
                'order_id' => 'spp-' . uniqid(),
                'nominal_pembayaran' => 240000,
                'jenis_pembayaran' => 'akhir-semester',
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updateSiswaByAdmin(Request $request, Siswa $siswa)
    {
        $valid = $this->adminInputValidate($request, false, false);
        unset($valid["nis"]);
        // dd($valid);
        $siswa->update($valid);
        Alamat::where("siswa_id", $siswa->id)->update([
            'alamat' => $valid["alamat"]
        ]);
        // return redirect()
        return redirect('/dashboard/siswa')->with('pesan', '<div class="alert alert-success mx-2" role="alert"> Data Siswa telah diupdate </div>');
    }
}
