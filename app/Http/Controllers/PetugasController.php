<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Management_Karyawan;
use App\Models\Data_Petugas;
use App\Models\Management_Jenis_Kendaraan;
use DB;
use Alert;

class PetugasController extends Controller
{
    public function index(){
        $data_petugas = DB::table('kendaraan')
                        ->leftjoin('management_jenis_kendaraan','management_jenis_kendaraan.jenis_kendaraan','=','kendaraan.kendaraan_jenis')
                        ->joinsub('select data_petugas_id, kendaraan_id,npp_petugas_1,npp_petugas_2 from data_petugas where status = 1','petugas','kendaraan.kendaraan_id','=','petugas.kendaraan_id','left')
                        ->where('kendaraan.status','=',1)
                        ->where('kendaraan.ruas_id','=',1)
                        ->select( 'npp_petugas_1','npp_petugas_2','kendaraan_nomor','kendaraan_jenis','petugas.kendaraan_id','management_jenis_kendaraan.jenis_kendaraan')->get();
        $kendaraan = Management_Jenis_Kendaraan::All();
        $karyawan = Management_Karyawan::All();
        $data=[
            'data_petugas' => $data_petugas,
            'kendaraan' => $kendaraan,
            'karyawan' => $karyawan
        ];
        return view('tic-area.petugas')->with('data',$data);
    }

    public function tambahDataPetugas($kendaraan_id,$npp_petugas_1,$npp_petugas_2){
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
        $kendaraan_baru = new Kendaraan;
        $kendaraan_baru -> kendaraan_jenis = $request->id_kendaraan[$key];
        $kendaraan_baru -> kendaraan_nomor = $v;
        $kendaraan_baru -> ruas_id = 1;
        $kendaraan_baru -> status = 1;
        $kendaraan_baru -> save();
        
    }

    public function insert(Request $request){
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
                        $kendaraan_baru = new Kendaraan;
                        $kendaraan_baru -> kendaraan_jenis = $request->id_kendaraan[$key];
                        $kendaraan_baru -> kendaraan_nomor = $v;
                        $kendaraan_baru -> ruas_id = 1;
                        $kendaraan_baru -> status = 1;
                        $kendaraan_baru->save();
                        
                        if($request->nama_petugas_1[$key][$k] != null || $request->nama_petugas_2[$key][$k] != null){
                            $request->request->add(['saved_kendaraan_id'=>$kendaraan_baru->kendaraan_id]);
                            $this->tambahDataPetugas($request->saved_kendaraan_id,$request->nama_petugas_1[$key][$k],$request->nama_petugas_2[$key][$k]);
                        }
                        else{
                            echo "nama petugasnya kosong kak";
                        }
                    }
                    else{
                        $kendaraan_id = Kendaraan::where('kendaraan_nomor','=',$v)->where('ruas_id','=',1)->selectraw('kendaraan_id')->first();
                        $petugas_lama = Data_Petugas::where('kendaraan_id','=',$kendaraan_id->kendaraan_id)->where('status','=',1)->first();
                        if($request->nama_petugas_1[$key][$k] != null || $request->nama_petugas_2[$key][$k] != null){
                            if($petugas_lama){
                                if($petugas_lama->npp_petugas_1 == $request->nama_petugas_1[$key][$k] && $petugas_lama->npp_petugas_2 == $request->nama_petugas_2[$key][$k]){
                                    echo "sama kak";
                                }
                                else{
                                $petugas_lama -> status = 0;
                                $petugas_lama -> save();
                                $this->tambahDataPetugas($kendaraan_id->kendaraan_id,$request->nama_petugas_1[$key][$k],$request->nama_petugas_2[$key][$k]);
                                }
                            }
                            else{
                                $this->tambahDataPetugas($kendaraan_id->kendaraan_id,$request->nama_petugas_1[$key][$k],$request->nama_petugas_2[$key][$k]);
                            }
                        }
                        else {
                            if($petugas_lama){
                                $petugas_lama -> status = 0;
                                $petugas_lama -> save();
                            }
                            else{
                                echo "emang ngga ada datanya kak";
                            }
                        }
                        $kendaraan_lama = Kendaraan::where('kendaraan_id','=',$kendaraan_id->kendaraan_id)->first();
                        if($kendaraan_lama){
                            $kendaraan_lama -> status = 1;
                            $kendaraan_lama -> save();
                        }
                        else{
                            echo "gagal mendapatkan kendaraan lama";
                        }
                    }
                }
            }
        }
        else{
            $list_kendaraan_db = Kendaraan::where('ruas_id','=',1)->where('status','=',1)->selectraw('kendaraan_id,kendaraan_nomor')->get();
            foreach($list_kendaraan_db as $list){
                if(in_array($list->kendaraan_nomor,$list_kendaraan_view))
                {  
                    echo "tidak dihapus";
                }
                else
                {
                    $kendaraan_lama = Kendaraan::where('kendaraan_id','=',$list->kendaraan_id)->first();
                    $petugas_lama = Data_Petugas::where('kendaraan_id','=',$list->kendaraan_id)->where('status','=',1)->first();
                    if($kendaraan_lama){
                        $kendaraan_lama-> status = 0;
                        $kendaraan_lama-> save();
                    } 
                    else{
                        echo "kendaraan_id tidak ditemukan";
                    }
                    if($petugas_lama){
                        $petugas_lama->status = 0;
                        $petugas_lama-> save();
                    }
                    else{
                        echo "petugas_lama tidak ditemukan";
                    }
                }
            }
            die();
        }
        return response()->json(['status' => true,'data' => null]);
    }
}
