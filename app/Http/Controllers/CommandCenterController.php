<?php

namespace App\Http\Controllers;

use App\Models\List_Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\ResponseFactory;

class CommandCenterController extends Controller
{
    public function index(){
        return view('command-center.dashboard-command-center');
    }

    public function LoadLaporan(){
        $list_laporan = DB::table('list_laporan')
                    -> select('*')
                    // -> selectraw("select laporan_created_timestamp,laporan_name,laporan_phone_no,laporan_vehicle_category,laporan_plat_no,laporan_ruas_id,laporan_description")
                    -> leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                    -> leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                    -> leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                    -> whereraw("laporan_forward_to_tic_timestamp is null and status_id = 1")
                    -> get();
        // dd($list_laporan);
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function ForwardTIC(Request $request){
        // dd($request);
        $cc_id = Session::get('npp');
        DB::table('list_laporan')->where('laporan_id',$request->laporan_id)
        ->update([
            'laporan_forward_to_tic_timestamp' => date('Y-m-d H:i:s'),
            'command_center_id' => $cc_id,
            'status_id' => 2,
        ]);
        return response()->json(['status' =>true, 'data' => null ]);
    }
}
