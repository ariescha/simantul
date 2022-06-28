<?php

namespace App\Exports;

use App\Models\List_Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;

class RekapExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.rekap-admin', [
            'list' => List_Laporan::all()
        ]);
    }
}
