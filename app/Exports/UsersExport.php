<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $siswa = Siswa::all();
        return $siswa;
    }
    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
}
