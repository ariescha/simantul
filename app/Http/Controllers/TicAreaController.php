<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\List_Laporan;
use App\Models\Management_Jenis_Kendaraan;
use App\Models\Data_Petugas;


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

        $ruasUser = Session::get('ruas');
        $list_laporan = DB::table('list_laporan')
                        ->select('*')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->whereRaw('list_laporan.laporan_ruas_id = '.$ruasUser.' AND laporan_forward_to_tic_timestamp IS NOT NULL')
                        ->where('list_laporan.status_id','>=',2)
                        ->orderBy('laporan_id', 'DESC')
                        ->get();
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function LoadDataPetugas(){
        date_default_timezone_set("Asia/Bangkok");
        $ruasUser = Session::get('ruas');
        $data_petugas_aktif = DB::table('data_petugas')
                                ->leftjoin('kendaraan','data_petugas.kendaraan_id','=','kendaraan.kendaraan_id')
                                ->leftjoin('management_jenis_kendaraan','kendaraan.kendaraan_jenis','=','management_jenis_kendaraan.jenis_kendaraan_id')
                                ->where('data_petugas.status','=',1)
                                ->where('kendaraan.ruas_id','=',$ruasUser)
                                ->where('onduty','=',0)
                                ->selectRaw('data_petugas_id,kendaraan_nomor,jenis_kendaraan')
                                ->get();
        $jenis_kendaraan = Management_Jenis_Kendaraan::All();
        $data = [
            'data_petugas_aktif' => $data_petugas_aktif,
            'jenis_kendaraan' => $jenis_kendaraan
        ];
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function AssignPetugas(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $list_petugas = array();
        $npp = Session::get('npp');
        foreach($request->data_petugas as $value){
            array_push($list_petugas,$value);
        }
        $laporan = List_Laporan::where('laporan_id','=',$request->laporan_id)->first();
        if($laporan){
            $laporan -> data_petugas_id = $list_petugas;
            $laporan -> laporan_forward_to_petugas_timestamp = date('Y-m-d H:i:s');
            $laporan -> status_id = 3;
            $laporan -> tic_id = $npp;
            $laporan -> save();

            foreach($request->data_petugas as $i){
                $petugas = Data_Petugas::where('data_petugas_id','=',$i)->first();
                $petugas -> onduty = 1;
                $petugas -> save();
            }

            return response()->json(['status' => true, 'data' => null]);
        }
        else{
            return response()->json(['status' => false, 'data' => null]);
        }
    }

    public function PetugasArrived(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $laporan = List_Laporan::where('laporan_id','=',$request->laporan_id)->first();

        if($laporan){
            $laporan -> laporan_petugas_arrived_timestamp = date('Y-m-d H:i:s');
            $laporan -> status_id = 4;
            $laporan -> save();

            return response()->json(['status' => true, 'data' => null]);
        }   
        else{
            return response()->json(['status' => false, 'data' => null]);
        }
    }

    public function PetugasDone(Request $request){
        // dd($request->laporan_id);
        date_default_timezone_set("Asia/Bangkok");
        $laporan = List_Laporan::where('laporan_id','=',$request->laporan_id)->first();
        $get_list_petugas = $laporan->data_petugas_id;
        $list_petugas = json_decode($get_list_petugas); 
        if($laporan){
            if($laporan -> status_id == 4){
                $laporan -> laporan_closed_timestamp = date('Y-m-d H:i:s');
                $laporan -> status_id = 5;
                $laporan -> save();
            }
            else if($laporan -> status_id == 3){
                $laporan -> laporan_closed_timestamp = date('Y-m-d H:i:s');
                $laporan -> status_id = 6;
                $laporan -> save();
            }

            foreach($list_petugas as $value){
                $petugas = Data_Petugas::where('data_petugas_id','=',$value)->first();
                $petugas -> onduty = 0;
                $petugas -> save();
            }

            return response()->json(['status' => true, 'data' => null]);
        }
        else{
            return response()->json(['status' => false, 'data' => null]);
        }
    }
}
