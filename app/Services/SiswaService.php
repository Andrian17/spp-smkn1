<?php

namespace App\Services;

use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Alamat;
use App\Models\Siswa;
use Illuminate\Support\Carbon;

class SiswaService
{

    public function updateSiswa(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $valid = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'semester' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'angkatan' => 'required',
            'alamat' => 'required',
            'foto' => 'image|file|max:2048'
        ]);

        $validTanggal = $this->checkPerbedaanTanggal($valid["tanggal_lahir"]);
        if ($validTanggal) {
            if ($request->hasFile('foto')) {
                $valid["foto"] = $request->foto->store('foto-siswa');
                // $isImage = strtolower($request->file('foto')->getClientOriginalExtension());
                // if ($isImage == "jpg" || $isImage == "jpeg" || $isImage == "png") {
                //     $valid["foto"] = $request->foto->store('foto-siswa');
                // }
            }
            Alamat::where("siswa_id", $siswa->id)->update([
                'alamat' => $valid["alamat"]
            ]);
            $siswa->update($valid);
            return redirect('/siswa')
                ->with('success', '<div class="alert alert-info" role="alert">Data siswa telah diperbarui</div>');
        }
        return redirect('/siswa')
            ->with('success', '<div class="alert alert-danger" role="alert">Data siswa gagal diperbarui, Cek Kembali Data anda!</div>');
    }

    // Cek Pebedaan Tanggal
    public function checkPerbedaanTanggal($startDate)
    {
        //parse string to dateTIme Carbon
        $startDate = Carbon::parse($startDate);
        $now = Carbon::parse(Carbon::now()->format('Y-m-d'));

        //selisih waktu sekarang dengan tanggal mulai
        $dayDifference = $now->diffInDays($startDate, false);

        // dd($dayDifference);
        if ($dayDifference < 1) {
            return true;
        }
        return false;
    }
}
