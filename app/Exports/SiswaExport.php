<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    // /**
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function collection()
    // {
    //     return Siswa::all();
    // }

    public function view(): View
    {
        return view('exports.excellSiswa', [
            'siswa' => Siswa::with('utsPayments')
                ->with('uasPayments')
                ->with('jurusan')
                ->with('kelas')
                ->with('alamat')
                ->get()
        ]);
    }
}
