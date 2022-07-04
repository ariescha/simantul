<?php

namespace App\Exports;

use App\Models\List_Laporan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class RekapExport implements FromView
{

    protected $id;

    function __construct($id){
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    

    public function view(): View
    {
        if ($this->id == 0){
            $Laporan = DB::table('list_laporan')
                        ->selectraw('*, timestampdiff(minute, list_laporan.laporan_created_timestamp, list_laporan.laporan_forward_to_tic_timestamp) as durasi_forward, timestampdiff(minute, list_laporan.laporan_forward_to_tic_timestamp, list_laporan.laporan_forward_to_petugas_timestamp) as durasi_assign, timestampdiff(minute, list_laporan.laporan_forward_to_petugas_timestamp, list_laporan.laporan_petugas_arrived_timestamp) as durasi_arrived, timestampdiff(minute, list_laporan.laporan_petugas_arrived_timestamp, list_laporan.laporan_closed_timestamp) as durasi_done')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->leftjoin('status_laporan_reference', 'list_laporan.status_id','=','status_laporan_reference.status_id')
                        ->leftjoin('tbl_feedback','list_laporan.feedback_id','=','tbl_feedback.feedback_id')
                        ->orderBy('laporan_id', 'DESC')
                        ->get();
            $Petugas = DB::table('data_petugas')->select('data_petugas_id','npp_petugas_1','npp_petugas_2','kendaraan_id')->get();
            $Karyawan = DB::table('management_karyawan')->select('npp','nama')->get();
            $Kendaraan = DB::table('kendaraan')->select('kendaraan_id','kendaraan_nomor')->get();

            for ($x = 0; $x < count($Laporan); $x++) {
                $csoId = $Laporan[$x] -> cso_id;
                $commandCenterId = $Laporan[$x] -> command_center_id;
                $ticId = $Laporan[$x] -> tic_id;
                $list_petugas = json_decode($Laporan[$x] -> data_petugas_id);
                if ($csoId != null){
                    for ($y = 0; $y < count($Karyawan); $y++) {
                        if ($csoId == $Karyawan[$y]->npp){
                            $Laporan[$x] -> cso_id_name = $Karyawan[$y]->nama;
                        }
                    }
                }else{
                    $Laporan[$x] -> cso_id_name = "";
                }

                if ($commandCenterId != null){
                    for ($y = 0; $y < count($Karyawan); $y++) {
                        if ($commandCenterId == $Karyawan[$y]->npp){
                            $Laporan[$x] -> command_center_id_name = $Karyawan[$y]->nama;
                        }
                    }
                }else{
                    $Laporan[$x] -> command_center_id_name = "";
                }

                if ($ticId != null){
                    for ($y = 0; $y < count($Karyawan); $y++) {
                        if ($ticId == $Karyawan[$y]->npp){
                            $Laporan[$x] -> tic_id_name = $Karyawan[$y]->nama;
                        }
                    }
                }else{
                    $Laporan[$x] -> tic_id_name = "";
                }
                $string = "";
                if($list_petugas){
                    foreach($list_petugas as $id_petugas){
                        for($y = 0; $y < count($Petugas); $y++){
                            if($id_petugas == $Petugas[$y]->data_petugas_id){
                                for($z = 0; $z < count($Kendaraan); $z++){
                                    if($Petugas[$y]->kendaraan_id == $Kendaraan[$z]->kendaraan_id){
                                        $string = $string.$Kendaraan[$z]->kendaraan_nomor." : ";
                                    }
                                }
                                $string = $string."(".$Petugas[$y]->npp_petugas_1.")"."(".$Petugas[$y]->npp_petugas_2.")\n";
                            }
                        }
                    }
                    $Laporan[$x] -> petugas = $string;
                }
                else{
                    $Laporan[$x] -> petugas = "";
                }
            }  
        } 
        else {
            $a_start = date("Y-m-d H:i:s", strtotime($this->id." 00:00:00"));
            $a_end = date("Y-m-d H:i:s", strtotime($this->id." 23:59:00"));
            $Laporan = DB::table('list_laporan')
                        ->selectraw('*, timestampdiff(minute, list_laporan.laporan_created_timestamp, list_laporan.laporan_forward_to_tic_timestamp) as durasi_forward, timestampdiff(minute, list_laporan.laporan_forward_to_tic_timestamp, list_laporan.laporan_forward_to_petugas_timestamp) as durasi_assign, timestampdiff(minute, list_laporan.laporan_forward_to_petugas_timestamp, list_laporan.laporan_petugas_arrived_timestamp) as durasi_arrived, timestampdiff(minute, list_laporan.laporan_petugas_arrived_timestamp, list_laporan.laporan_closed_timestamp) as durasi_done')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->leftjoin('status_laporan_reference', 'list_laporan.status_id','=','status_laporan_reference.status_id')
                        ->leftjoin('tbl_feedback','list_laporan.feedback_id','=','tbl_feedback.feedback_id')
                        ->whereBetween('laporan_created_timestamp',[$a_start,$a_end])
                        ->orderBy('laporan_id', 'DESC')
                        ->get();
            $Petugas = DB::table('data_petugas')->select('data_petugas_id','npp_petugas_1','npp_petugas_2','kendaraan_id')->get();
            $Karyawan = DB::table('management_karyawan')->select('npp','nama')->get();
            $Kendaraan = DB::table('kendaraan')->select('kendaraan_id','kendaraan_nomor')->get();

            for ($x = 0; $x < count($Laporan); $x++) {
                $csoId = $Laporan[$x] -> cso_id;
                $commandCenterId = $Laporan[$x] -> command_center_id;
                $ticId = $Laporan[$x] -> tic_id;
                $list_petugas = json_decode($Laporan[$x] -> data_petugas_id);
                if ($csoId != null){
                    for ($y = 0; $y < count($Karyawan); $y++) {
                        if ($csoId == $Karyawan[$y]->npp){
                            $Laporan[$x] -> cso_id_name = $Karyawan[$y]->nama;
                        }
                    }
                }else{
                    $Laporan[$x] -> cso_id_name = "";
                }

                if ($commandCenterId != null){
                    for ($y = 0; $y < count($Karyawan); $y++) {
                        if ($commandCenterId == $Karyawan[$y]->npp){
                            $Laporan[$x] -> command_center_id_name = $Karyawan[$y]->nama;
                        }
                    }
                }else{
                    $Laporan[$x] -> command_center_id_name = "";
                }

                if ($ticId != null){
                    for ($y = 0; $y < count($Karyawan); $y++) {
                        if ($ticId == $Karyawan[$y]->npp){
                            $Laporan[$x] -> tic_id_name = $Karyawan[$y]->nama;
                        }
                    }
                }else{
                    $Laporan[$x] -> tic_id_name = "";
                }
                $string = "";
                if($list_petugas){
                    foreach($list_petugas as $id_petugas){
                        for($y = 0; $y < count($Petugas); $y++){
                            if($id_petugas == $Petugas[$y]->data_petugas_id){
                                for($z = 0; $z < count($Kendaraan); $z++){
                                    if($Petugas[$y]->kendaraan_id == $Kendaraan[$z]->kendaraan_id){
                                        $string = $string.$Kendaraan[$z]->kendaraan_nomor." : ";
                                    }
                                }
                                $string = $string."(".$Petugas[$y]->npp_petugas_1.")"."(".$Petugas[$y]->npp_petugas_2.")\n";
                            }
                        }
                    }
                    $Laporan[$x] -> petugas = $string;
                }
                else{
                    $Laporan[$x] -> petugas = "";
                }
            }  
        }  
        
        return view('export.rekap-admin', compact('Laporan'));
    }
}
