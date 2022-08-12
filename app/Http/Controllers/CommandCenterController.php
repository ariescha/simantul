<?php

namespace App\Http\Controllers;

use App\Models\List_Laporan;
use App\Models\Management_Ruas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\ResponseFactory;

class CommandCenterController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        $ruas = DB::table('management_ruas')->where('ruas_id','!=',0)->orderBy('ruas_name','ASC')->get();
        return view('command-center.dashboard-command-center')->with('ruas',$ruas);
    }

    public function LoadLaporan(){
        date_default_timezone_set("Asia/Bangkok");

        $list_laporan = DB::table('list_laporan')
                    -> select('*')
                    -> leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                    -> leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                    -> leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                    -> whereraw("laporan_forward_to_tic_timestamp is null and status_id = 1")
                    -> get();
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function LoadLaporanSelesai(){
        date_default_timezone_set("Asia/Bangkok");

        $list_laporan = DB::table('list_laporan')
                    -> select('*')
                    -> leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                    -> leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                    -> leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                    -> whereraw("status_id >= 2")
                    -> get();
      
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function ForwardTIC(Request $request){
        date_default_timezone_set("Asia/Bangkok");

        $cc_id = Session::get('npp');
        DB::table('list_laporan')->where('laporan_id',$request->laporan_id)
        ->update([
            'laporan_forward_to_tic_timestamp' => date('Y-m-d H:i:s'),
            'command_center_id' => $cc_id,
            'status_id' => 2,
            'laporan_assigned_ruas_id' => $request->ruas,
        ]);
        return response()->json(['status' =>true, 'data' => null ]);
    }
}
