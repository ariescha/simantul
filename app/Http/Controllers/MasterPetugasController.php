<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master_Petugas;
use App\Models\Management_Jenis_Kendaraan;
use App\Models\Management_Ruas;

use Illuminate\Support\Facades\DB;

class MasterPetugasController extends Controller
{
    public function index(){
        $kendaraan = Management_Jenis_Kendaraan::all();
        $ruas = Management_Ruas::all();

        return view('tic-area.master-petugas')->with(['kendaraan' => $kendaraan, 'ruas' => $ruas]);
    }

    public function LoadPetugas(){
        date_default_timezone_set("Asia/Bangkok");
        $list_petugas = DB::table('management_petugas')
                    -> select('*')
                    -> leftjoin('management_ruas', 'management_petugas.ruas_id','=','management_ruas.ruas_id')
                    -> leftjoin('management_jenis_kendaraan', 'management_petugas.jenis_petugas','=','management_jenis_kendaraan.jenis_kendaraan_id')
                    -> get();
        return response()->json(['status' => true, 'data' => $list_petugas]);
    }

    public function addPetugas(Request $request){
        date_default_timezone_set("Asia/Bangkok");


        $dataPetugas = DB::table('management_petugas')->where('nik_petugas',$request->tambah_nik_petugas)->first();
        
        if (is_null($dataPetugas)){
            Master_Petugas::create([
                'nik_petugas'               => $request->tambah_nik_petugas,
                'nama_petugas'              => $request->tambah_nama_petugas,
                'jenis_petugas'             => $request->tambah_spesialisasi,
                'ruas_id'                   => $request->tambah_ruas,
            ]);
            return response()->json(['status' =>true, 'data' => null ]);
        }else{
            return response()->json(['status' =>false, 'data' => 'Gagal, NIK sudah terdaftar!' ]);
        } 
    }

    public function editPetugas(Request $request){
        date_default_timezone_set("Asia/Bangkok");

        if($request->nik_petugas==$request->edit_nik_petugas){
            DB::table('management_petugas')->where('nik_petugas',$request->nik_petugas)
            ->update([
                'nik_petugas'               => $request->edit_nik_petugas,
                'nama_petugas'              => $request->edit_nama_petugas,
                'jenis_petugas'             => $request->edit_spesialisasi,
                'ruas_id'                   => $request->edit_ruas,
            ]);

            return response()->json(['status' =>true, 'data' => null ]);
        }else{
            $dataPetugas = DB::table('management_petugas')->where('nik_petugas',$request->edit_nik_petugas)->first();

            if (is_null($dataPetugas)){
            // dd($request);
                DB::table('management_petugas')->where('nik_petugas',$request->nik_petugas)
                        ->update([
                            'nik_petugas'               => $request->edit_nik_petugas,
                            'nama_petugas'              => $request->edit_nama_petugas,
                            'jenis_petugas'             => $request->edit_spesialisasi,
                            'ruas_id'                   => $request->edit_ruas,
                        ]);
            
                return response()->json(['status' =>true, 'data' => null ]);
            }else{
                return response()->json(['status' =>false, 'data' => 'Gagal Update, NIK sudah terdaftar!' ]);
            }
        } 
    }

    public function dropPetugas(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        DB::table('management_petugas')->where('nik_petugas',$request->drop_nik_petugas)
        ->delete();
        return response()->json(['status'=> true, 'data'=>null]);
    }
}
