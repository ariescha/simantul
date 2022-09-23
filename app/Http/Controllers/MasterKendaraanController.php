<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\Master_Petugas;
use App\Models\Management_Jenis_Kendaraan;
use App\Models\Management_Ruas;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MasterKendaraanController extends Controller
{
    public function index(){
        $record = Kendaraan::where('ruas_id', Session::get('ruas'))->get();
        $jenis_kendaraan = Management_Jenis_Kendaraan::all();
        return view('tic-area.master-kendaraan',[
            'record' => $record,
            'jenis_kendaraan' => $jenis_kendaraan
        ]);
    }

    public function grid(){
        $record = Kendaraan::get();
        return response()->json($record);
    }

    public function store(Request $request)
    {
        $record = new Kendaraan;
        $record->kendaraan_jenis = $request->kendaraan_jenis;
        $record->kendaraan_nomor = $request->kendaraan_nomor;
        $record->ruas_id = Session::get('ruas');
        $record->save();
        
        return response()->json($record);
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
