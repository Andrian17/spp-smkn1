<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Http\Requests\UpdateSiswaRequest;
use App\Services\SiswaService;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::with('alamat')->where('user_id', auth()->user()->id)->first();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();

        return view('siswa.siswaDetail', [
            'siswa' => $siswa,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'title' => 'Data Siswa'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $pdf = PDF::loadView('pdf.laporanSiswa', ['siswa' => $siswa, 'title' => 'Laporan Pembayaran']);
        return $pdf->stream('laporan-siswa.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('siswa.editSiswa', ["siswa" => $siswa, "kelas" => $kelas, "jurusan" => $jurusan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $updateSiswa = new SiswaService();
        return $updateSiswa->updateSiswa($request, $siswa);
    }
}
