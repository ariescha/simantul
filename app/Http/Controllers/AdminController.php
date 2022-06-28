<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\List_Laporan;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    
    //ajax
    public function LoadLaporanAdmin(){
        date_default_timezone_set("Asia/Bangkok");

        $list_laporan = DB::table('list_laporan')
                        ->select('*')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->leftjoin('status_laporan_reference', 'list_laporan.status_id','=','status_laporan_reference.status_id')
                        ->orderBy('laporan_id', 'DESC')
                        ->get();

        $management_karyawan = DB::table('management_karyawan')->select('npp','nama')->get();
        // echo ($management_karyawan);

        for ($x = 0; $x < count($list_laporan); $x++) {
            $csoId = $list_laporan[$x] -> cso_id;
            $commandCenterId = $list_laporan[$x] -> command_center_id;
            $ticId = $list_laporan[$x] -> tic_id;

            if ($csoId != null){
                for ($y = 0; $y < count($management_karyawan); $y++) {
                    if ($csoId == $management_karyawan[$y]->npp){
                        $list_laporan[$x] -> cso_id_name = $management_karyawan[$y]->nama;
                    }
                }
            }else{
                $list_laporan[$x] -> cso_id_name = "";
            }

            if ($commandCenterId != null){
                for ($y = 0; $y < count($management_karyawan); $y++) {
                    if ($commandCenterId == $management_karyawan[$y]->npp){
                        $list_laporan[$x] -> command_center_id_name = $management_karyawan[$y]->nama;
                    }
                }
            }else{
                $list_laporan[$x] -> command_center_id_name = "";
            }

            if ($ticId != null){
                for ($y = 0; $y < count($management_karyawan); $y++) {
                    if ($ticId == $management_karyawan[$y]->npp){
                        $list_laporan[$x] -> tic_id_name = $management_karyawan[$y]->nama;
                    }
                }
            }else{
                $list_laporan[$x] -> tic_id_name = "";
            }

            // print_r($list_laporan[$x]);
            // echo ($csoId);
            // echo ($commandCenterId);
            // echo ($ticId);

            // echo ('==================');
        }


        return response()->json(['status' => true, 'data' => $list_laporan]);
    }
    
}
