<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\UasPayment;
use App\Models\UtsPayment;
// use Illuminate\Http\Request;

use App\Models\Alamat;
use App\Models\Kelas;
use App\Services\AdminService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->middleware('admin');
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlahSiswa = Siswa::all()->count();
        $jumlahPembayaran = UtsPayment::all()->count() + UasPayment::all()->count();
        $jumlahJurusan = Jurusan::all()->count();

        return view('admin.adminDashboard', [
            "jumlahSiswa" => $jumlahSiswa,
            "jumlahPembayaran" => $jumlahPembayaran,
            "jumlahJurusan" => $jumlahJurusan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahSiswa()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('admin.tambahSiswa', [
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'title' => 'Tambah Siswa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function simpanSiswa(StoreAdminRequest $request)
    {
        DB::transaction(function () use ($request) {
            $saveUser = $this->adminService->userSave($request);
            $saveSiswa = $this->adminService->siswaSave($request, $saveUser->id);
            $saveAlamat = $this->adminService->alamatSave($request, $saveSiswa->id);
        });
        return redirect('/dashboard/tambah-siswa')->with('pesan', '<div class="alert alert-success mx-2" role="alert"> Siswa berhasil ditambahkan </div>');
    }

    public function exportExcell()
    {
        return Excel::download(new SiswaExport, 'pembayaran.xlsx');
    }

    public function exportPDF()
    {
        $siswa = Siswa::with('utsPayments')
            ->with('uasPayments')
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->get();
        $pdf = PDF::loadView('exports.laporanPembayaran', ['siswa' => $siswa])->setPaper('a4', 'potrait');
        return $pdf->stream('laporanSPP.pdf');
    }

    // Semua Data Siswa
    public function semuaSiswa()
    {
        $siswa = Siswa::with('utsPayments')
            ->with('uasPayments')
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->latest()->get();
        return view('admin.semuaSiswa', [
            'siswa' => $siswa,
            'title' => "Data Siswa"
        ]);
    }

    // Semua Data Pembayaran
    public function semuaPembayaran()
    {
        $siswa = Siswa::with('utsPayments')
            ->with('uasPayments')
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->get();
        return view('admin.allPembayaran', [
            'siswa' => $siswa,
            'title' => 'Data Pembayaran'
        ]);
    }

    // Semua Data Kelas
    public function semuaKelas()
    {
        $kelas = Siswa::with('utsPayment')
            ->with('uasPayment')
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->get();
        return view('admin.allKelas', compact('kelas'));
    }

    public function tampilSiswa(Siswa $siswa)
    {
        return view('admin.tampilSiswa', [
            'siswa' => $siswa,
            'title' => 'Detail Siswa'
        ]);
    }

    public function editSiswa(Siswa $siswa)
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('admin.editSiswa', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
        ]);
    }

    public function updateSiswa(UpdateAdminRequest $request, Siswa $siswa)
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
            'alamat' => 'required'
        ]);
        // dd($valid);
        $siswa->update($valid);
        Alamat::where("siswa_id", $siswa->id)->update([
            'alamat' => $valid["alamat"]
        ]);
        // return redirect()
        return redirect('/dashboard/siswa')->with('pesan', '<div class="alert alert-success mx-2" role="alert"> Data Siswa telah diupdate </div>');
    }
}
