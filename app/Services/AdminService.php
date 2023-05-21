<?php

namespace App\Services;

use App\Http\Requests\StoreAdminRequest;
use App\Models\Alamat;
use App\Models\Siswa;
use App\Models\UasPayment;
use App\Models\User;
use App\Models\UtsPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminService
{

    public function adminInputValidate(StoreAdminRequest $storeAdminRequest, $forUserSave = false, $forSiswaSave = false)
    {
        $adminInputValidate = $storeAdminRequest->validate([
            'email' => $forUserSave ? 'required|email|unique:users' : 'required',
            'nama' => 'required',
            'nis' => $forSiswaSave ? 'required|unique:siswas' : 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|min:11|numeric',
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

    public function userSave(StoreAdminRequest $storeAdminRequest)
    {
        $userValidate = $this->adminInputValidate($storeAdminRequest, true);
        $userValidate['name'] = $storeAdminRequest->input("nama");
        $userValidate['password'] = Hash::make($storeAdminRequest->input("nis"));
        try {
            $saveUser = User::create($userValidate);
            return $saveUser;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function siswaSave(StoreAdminRequest $request, $userId)
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

    public function alamatSave(StoreAdminRequest $storeAdminRequest, $siswaId)
    {
        $alamatValidated = $this->adminInputValidate($storeAdminRequest);
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
}
