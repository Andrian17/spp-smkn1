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

use App\Http\Requests;
use App\Models\Alamat;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;




class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminDashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $siswa = Siswa::all();

        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('admin.tambahSiswa', [
            'jurusan' => $jurusan,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        DB::transaction(function () use ($request) {
            // Create User
            $user = $request->validate([
                'email' => 'required|email|unique:users',
                'nama' => 'required',
            ]);
            $user['name'] = $request->nama;
            $user['password'] = Hash::make($request->nis);
            $saveUser = User::create($user);
            // Create Siswa
            $siswa = $request->validate([
                'nis' => 'required|unique:siswas',
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'no_hp' => 'required|numeric|min:11',
                'semester' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'jurusan_id' => 'required',
                'kelas_id' => 'required',
                'angkatan' => 'required'
            ]);
            $siswa["user_id"] = $saveUser->id;
            $saveSiswa = Siswa::create($siswa);
            // Create Alamat
            $alamat = $request->validate([
                'alamat' => 'required'
            ]);
            $alamat["siswa_id"] = $saveSiswa->id;
            Alamat::create($alamat);
            // Create Payment
            $this->_createPayments($saveSiswa->id);
        });
        return redirect('/dashboard/getAllSiswa')->with('pesan', '<div class="alert alert-success mx-2" role="alert"> Data Siswa baru telah ditambahkan </div>');
    }

    private function _createPayments($siswa_id)
    {
        $siswa = $siswa_id;
        DB::transaction(function () use ($siswa) {
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
        });
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    // Semua Data Siswa
    public function getAllSiswa()
    {
        $siswa = Siswa::with('utsPayments')
            ->with('uasPayments')
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->get();
        return view('admin.allSiswa', compact('siswa'));
    }

    // Semua Data Pembayaran
    public function allPembayaran()
    {
        $siswa = Siswa::with('utsPayments')
            ->with('uasPayments')
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->get();
        return view('admin.allPembayaran', ['siswa' => $siswa]);
    }

    // Semua Data Kelas
    public function allKelas()
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
        return view('admin.tampilSiswa', compact('siswa'));
    }
}
