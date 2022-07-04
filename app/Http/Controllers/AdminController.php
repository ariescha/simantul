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
                        // ->select('*')
                        ->selectraw('*, TIMESTAMPDIFF(MINUTE, laporan_created_timestamp, laporan_closed_timestamp) AS totaltimeminute,
                        TIMESTAMPDIFF(MINUTE, laporan_created_timestamp, laporan_forward_to_tic_timestamp) AS total_forward_tic,
                        TIMESTAMPDIFF(MINUTE, laporan_forward_to_tic_timestamp, laporan_forward_to_petugas_timestamp) AS total_forward_petugas,
                        TIMESTAMPDIFF(MINUTE, laporan_forward_to_petugas_timestamp, laporan_petugas_arrived_timestamp) AS total_petugas_arrived,
                        TIMESTAMPDIFF(MINUTE, laporan_petugas_arrived_timestamp, laporan_closed_timestamp) AS total_arrived_close
                        ')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->leftjoin('status_laporan_reference', 'list_laporan.status_id','=','status_laporan_reference.status_id')
                        ->leftjoin('tbl_feedback', 'list_laporan.feedback_id','=','tbl_feedback.feedback_id')
                        ->orderBy('laporan_id', 'DESC')
                        ->get();

        $management_karyawan = DB::table('management_karyawan')->select('npp','nama')->get();
        $data_petugas = DB::table('data_petugas')->select('*')
                        ->leftjoin('kendaraan', 'data_petugas.kendaraan_id','=','kendaraan.kendaraan_id')
                        ->get();
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



            if($list_laporan[$x] -> feedback_rate == null){
                $list_laporan[$x] -> rating_pelanggan = 0;
            }else{
                $list_laporan[$x] -> rating_pelanggan = $list_laporan[$x] -> feedback_rate;
            }
            


            //loop untuk petugas id
            if ($list_laporan[$x] -> data_petugas_id != null){
                $tempPetugas = json_decode($list_laporan[$x] -> data_petugas_id);
                
                $stringBuilderPetugas = "";
                for ($y = 0; $y < count($tempPetugas); $y++) {
                    for ($z = 0; $z < count($data_petugas); $z++) {
                        if ($tempPetugas[$y] == $data_petugas[$z]->data_petugas_id){
                            if($data_petugas[$z]->npp_petugas_1!=null){
                                $stringBuilderPetugas .= $data_petugas[$z]->kendaraan_nomor;
                                $stringBuilderPetugas .= "-";
                                $stringBuilderPetugas .= $data_petugas[$z]->npp_petugas_1;
                                $stringBuilderPetugas .= ", ";
                            }
                            if($data_petugas[$z]->npp_petugas_2!=null){
                                $stringBuilderPetugas .= $data_petugas[$z]->kendaraan_nomor;
                                $stringBuilderPetugas .= "-";
                                $stringBuilderPetugas .= $data_petugas[$z]->npp_petugas_2;
                                $stringBuilderPetugas .= ", ";
                            }
                        }
                    }
                    

                }
                $stringFinal = substr($stringBuilderPetugas, 0, -2);
                                    
                $list_laporan[$x] -> data_petugas_generate = $stringFinal;
                // echo("batas");
            }else{
                $list_laporan[$x] -> data_petugas_generate = "-";
            }


        }


        return response()->json(['status' => true, 'data' => $list_laporan]);
    }
    
}
