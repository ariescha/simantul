<?php

namespace App\Http\Controllers;

use App\Models\List_Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\ResponseFactory;

class RekapitulasiCCController extends Controller
{
    public function index(){
        return view('command-center.rekapitulasi-command-center');
    }

    public function LoadRekapitulasi(){
        $list_laporan = DB::table('list_laporan')
                        ->selectraw("count(distinct laporan_id) as cnt_diterima, count(distinct case when laporan_forward_to_tic_timestamp is not null then laporan_id end) as cnt_diteruskan, count(distinct case when data_petugas_id is not null then laporan_id end) as cnt_ditindak")
                        ->get();
        // dd($list_laporan);
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }
}
