<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\List_Laporan;


class TicAreaController extends Controller
{
    //
    public function index(){
        date_default_timezone_set("Asia/Bangkok");

         return view('tic-area.dashboard');
        
    }
    
    //ajax
    public function LoadLaporanTic(){
        date_default_timezone_set("Asia/Bangkok");

        // $ruasUser = Session::get('ruas_user');
        $ruasUser = 1;

        $list_laporan = DB::table('list_laporan')
                        ->select('*')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->whereRaw('list_laporan.laporan_ruas_id = '.$ruasUser.' AND laporan_forward_to_tic_timestamp IS NOT NULL')
                        ->orderBy('laporan_id', 'DESC')
                        ->get();
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }
}
