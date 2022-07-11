<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Master_Petugas;
use App\Models\Data_Petugas;
use App\Models\Management_Jenis_Kendaraan;
use DB;
use Alert;

class PetugasController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Bangkok");
        $data_petugas = DB::table('kendaraan')
                        ->leftjoin('management_jenis_kendaraan','management_jenis_kendaraan.jenis_kendaraan','=','kendaraan.kendaraan_jenis')
                        ->joinsub('select data_petugas_id, kendaraan_id,npp_petugas_1,npp_petugas_2 from data_petugas where status = 1','petugas','kendaraan.kendaraan_id','=','petugas.kendaraan_id','left')
                        ->where('kendaraan.status','=',1)
                        ->where('kendaraan.ruas_id','=',1)
                        ->select( 'npp_petugas_1','npp_petugas_2','kendaraan_nomor','kendaraan_jenis','petugas.kendaraan_id','management_jenis_kendaraan.jenis_kendaraan')->get();
        $kendaraan = Management_Jenis_Kendaraan::All();
        $petugas = Master_Petugas::All();
        
        $data=[
            'data_petugas' => $data_petugas,
            'kendaraan' => $kendaraan,
            'petugas' => $petugas
        ];
        return view('tic-area.petugas')->with('data',$data);
    }

    public function tambahDataPetugas($kendaraan_id,$npp_petugas_1,$npp_petugas_2){
        date_default_timezone_set("Asia/Bangkok");
        if($npp_petugas_1 == null) {$npp_petugas_1 = "";};
        if($npp_petugas_2 == null) {$npp_petugas_2 = "";};
        $data_petugas = new Data_Petugas;
        $data_petugas -> kendaraan_id = $kendaraan_id;
        $data_petugas -> tanggal = date('Y-m-d H:i:s');
        $data_petugas -> shift = 1;
        $data_petugas -> npp_petugas_1 = $npp_petugas_1;
        $data_petugas -> npp_petugas_2 = $npp_petugas_2;
        $data_petugas -> status = 1;
        $data_petugas -> created_by = 'aa';
        $data_petugas -> updated_by = 'bb';
        $data_petugas -> save();
        return;
    }

    public function tambahDataKendaraan($kendaraan_jenis,$kendaraan_nomor){
        date_default_timezone_set("Asia/Bangkok");
        $kendaraan_baru = new Kendaraan;
        $kendaraan_baru -> kendaraan_jenis = $kendaraan_jenis;
        $kendaraan_baru -> kendaraan_nomor = $kendaraan_nomor;
        $kendaraan_baru -> ruas_id = 1;
        $kendaraan_baru -> status = 1;
        $kendaraan_baru -> save();
        
        return $kendaraan_baru->kendaraan_id;
    }

    public function updateDataPetugas($kendaraan_id,$status,$onduty){
        date_default_timezone_set("Asia/Bangkok");
        $petugas = Data_Petugas::where('kendaraan_id','=',$kendaraan_id)->where('status','=',1)->first();
        if ($petugas){
            $petugas -> status = $status;
            $petugas -> onduty = $onduty;
            $petugas -> save();
            return;
        }
        else{
            return "Data Petugas tidak ditemukan";
        }
    }

    public function updateDataKendaraan($kendaraan_id,$status){
        date_default_timezone_set("Asia/Bangkok");
        $kendaraan = Kendaraan::where('kendaraan_id','=',$kendaraan_id)->first();
        if ($kendaraan){
            $kendaraan -> status = $status;
            $kendaraan -> save(); 
            return;
        }  
        else {
            return "Data Kendaraan tidak ditemukan";
        }

        return;
    }



    public function insert(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        
        ////////////////////////// Start Check Duplicate /////////////////////////
        $listnama = array();
        foreach($request->nama_petugas_1 as $key => $value){
            foreach($value as $ke => $v){
                array_push($listnama,$v);
            }
        }
        foreach($request->nama_petugas_2 as $key => $value){
            foreach($value as $ke => $v){
                array_push($listnama,$v);
            }
        }
        if(count(array_unique($listnama))<count($listnama)){
            return response()->json(['status' => false,'data' => 'Gagal, ada data duplikat!']);
        }
        ////////////////////////// End Check Duplicate /////////////////////////


        $nomor_kendaraan = $request->nomor_kendaraan;
        $list_kendaraan_view = array();
        foreach($nomor_kendaraan as $key => $value){
            foreach($value as $ke => $v){
                array_push($list_kendaraan_view,$v);
            }
        }
        
        $total_kendaraan_view = count($list_kendaraan_view);
        $total_kendaraan_db = Kendaraan::where('ruas_id','=',1)->where('status','=',1)->selectraw('count(kendaraan_nomor) as total')->first();
        
        if($total_kendaraan_view >= $total_kendaraan_db->total){
            foreach( $nomor_kendaraan as $key => $value){
                foreach($value as $k => $v){
                    $kendaraan_all = Kendaraan::where('kendaraan_nomor','=',$v)->where('ruas_id','=',1)->selectraw('count(kendaraan_nomor) as hitungan')->first();
                    if($kendaraan_all->hitungan == 0){
                        $kendaraan_baru_id = $this->tambahDataKendaraan($request->id_kendaraan[$key],$v);

                        if($request->nama_petugas_1[$key][$k] != null || $request->nama_petugas_2[$key][$k] != null){
                            $this->tambahDataPetugas($kendaraan_baru_id,$request->nama_petugas_1[$key][$k],$request->nama_petugas_2[$key][$k]);
                        }
                        else{
                        }
                    }
                    else{
                        $kendaraan_id = Kendaraan::where('kendaraan_nomor','=',$v)->where('ruas_id','=',1)->selectraw('kendaraan_id')->first();
                        $check_data_petugas_lama = Data_Petugas::where('kendaraan_id','=',$kendaraan_id->kendaraan_id)->where('status','=',1)->first();
                        if($request->nama_petugas_1[$key][$k] != null || $request->nama_petugas_2[$key][$k] != null){
                            if($check_data_petugas_lama){
                                if($check_data_petugas_lama->npp_petugas_1 == $request->nama_petugas_1[$key][$k] && $check_data_petugas_lama->npp_petugas_2 == $request->nama_petugas_2[$key][$k]){
                                }
                                else{
                                    $this->updateDataPetugas($kendaraan_id->kendaraan_id,0,0);
                                    $this->tambahDataPetugas($kendaraan_id->kendaraan_id,$request->nama_petugas_1[$key][$k],$request->nama_petugas_2[$key][$k]);
                                }
                            }
                            else{
                                $this->tambahDataPetugas($kendaraan_id->kendaraan_id,$request->nama_petugas_1[$key][$k],$request->nama_petugas_2[$key][$k]);
                            }
                        }
                        else {
                            $this->updateDataPetugas($kendaraan_id->kendaraan_id,0,0);
                        }
                        $this->updateDataKendaraan($kendaraan_id->kendaraan_id,1);
                    }
                }
            }
        }
        else{
            $list_kendaraan_db = Kendaraan::where('ruas_id','=',1)->where('status','=',1)->selectraw('kendaraan_id,kendaraan_nomor')->get();
            foreach($list_kendaraan_db as $list){
                if(in_array($list->kendaraan_nomor,$list_kendaraan_view))
                {  
                   
                }
                else
                {
                    $this->updateDataKendaraan($list->kendaraan_id,0);
                    $this->updateDataPetugas($list->kendaraan_id,0,0);
                }
            }
        }
        return response()->json(['status' => true,'data' => null]);
    }
}
