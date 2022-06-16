<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Http\Requests\StoreJurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;
use App\Models\Siswa;
use Illuminate\Validation\Validator;

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
        $jurusan = Jurusan::all();
        $style = [
            'bg-primary' => 'bg-primary',
            'bg-success' => 'bg-success',
            'bg-warning' => 'bg-warning',
            'bg-secondary' => 'bg-secondary',
        ];
        // dd($jurusan);
        return view('admin.jurusan', ["jurusan" => $jurusan, "style" => $style]);
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
     * @param  \App\Http\Requests\StoreJurusanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJurusanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        // return response()->json($jurusan);
        $siswa = $jurusan->siswa;
        return view('jurusan.editJurusan', ['jurusan' => $jurusan, 'siswa' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        $siswa = $jurusan->siswa;
        return view('jurusan.editJurusan', ['jurusan' => $jurusan, 'siswa' => $siswa]);
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
        dd($request->all());
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        //
    }
}
