<?php

namespace App\Http\Controllers;

use App\Models\List_Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\ResponseFactory;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExportCC;

class RekapitulasiCCController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        return view('command-center.rekapitulasi-command-center');
    }

    public function LoadRekapitulasiCC($id){
        date_default_timezone_set("Asia/Bangkok");
        if($id == 0){
            $list_laporan = DB::table('list_laporan')
                        ->selectraw("count(distinct laporan_id) as cnt_diterima, count(distinct case when laporan_forward_to_tic_timestamp is not null then laporan_id end) as cnt_diteruskan, count(distinct case when data_petugas_id is not null then laporan_id end) as cnt_ditindak")
                        ->get();
        }else{
            $a_start = date("Y-m-d H:i:s", strtotime($id." 00:00:00"));
            $a_end = date("Y-m-d H:i:s", strtotime($id." 23:59:00"));
            $list_laporan = DB::table('list_laporan')->whereBetween('laporan_created_timestamp',[$a_start,$a_end])
                        ->selectraw("count(distinct laporan_id) as cnt_diterima, count(distinct case when laporan_forward_to_tic_timestamp is not null then laporan_id end) as cnt_diteruskan, count(distinct case when data_petugas_id is not null then laporan_id end) as cnt_ditindak")
                        ->get();
        }
        
        // dd($list_laporan);
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function ExportExcel(Request $request){
        $a = 0;
        if($request->tanggal == null){
            $a = 0;
        }
        else{
            $a = $request->tanggal;
        }
        return Excel::download(new RekapExportCC($a), 'Rekapitulasi.xlsx');
    }
}
