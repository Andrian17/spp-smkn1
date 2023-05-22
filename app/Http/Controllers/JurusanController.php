<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Http\Requests\StoreJurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;

class JurusanController extends Controller
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
        $jurusan = Jurusan::with('siswa')->get();
        $style = [
            'bg-primary' => 'bg-primary',
            'bg-success' => 'bg-success',
            'bg-warning' => 'bg-warning',
            'bg-secondary' => 'bg-secondary',
        ];
        // dd($jurusan);
        return view(
            'admin.jurusan',
            [
                "jurusan" => $jurusan,
                "style" => $style,
                "title" => "Data Jurusan"
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJurusanRequest  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        // $jurusan->update($request->only('jurusan'));
        $valid = $request->validate([
            "jurusan" => "required|unique:jurusans"
        ]);
        $jurusan->update($valid);
        return redirect()
            ->route('jurusan.index')
            ->with('pesan', '<div class="alert alert-info" role="alert">Jurusan berhasil diperbarui</div>');
    }
}
