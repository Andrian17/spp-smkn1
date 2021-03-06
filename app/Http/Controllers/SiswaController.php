<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Alamat;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
// use Barryvdh\DomPDF\PDF;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaRequest $request)
    {
        dd($request->all());
        return;
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
        //
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
        Alamat::where("siswa_id", $siswa->id)->update([
            'alamat' => $valid["alamat"]
        ]);
        if ($request->hasFile('foto')) {
            $valid["foto"] = $request->foto->store('foto-siswa');
        }
        $siswa->update($valid);
        return redirect('/siswa')
            ->with('success', '<div class="alert alert-info" role="alert">Data siswa telah diperbarui</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
