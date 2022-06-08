<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
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
        $siswa = Siswa::latest()->get();
        // dd($siswa);
        // $utsPay = Siswa::where('status', '=', '1')->count();
        return view('admin.allSiswa', compact('siswa'));
    }

    // Semua Data Pembayaran
    public function allPembayaran()
    {
        $pembayaran = Siswa::latest()->paginate(10);
        return view('admin.allPembayaran', compact('pembayaran'));
    }

    // Semua Data Kelas
    public function allKelas()
    {
        $kelas = Siswa::latest()->paginate(10);
        return view('admin.allKelas', compact('kelas'));
    }

    // Semua Data Jurusan
    public function allJurusan()
    {
        $jurusan = Siswa::latest()->paginate(10);
        return view('admin.allJurusan', compact('jurusan'));
    }

    public function tampilSiswa(Siswa $siswa)
    {
        return view('admin.tampilSiswa', compact('siswa'));
    }
}
