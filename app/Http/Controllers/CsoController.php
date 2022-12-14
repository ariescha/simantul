<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\List_Laporan;

class CsoController extends Controller
{

    public function index(){
        date_default_timezone_set("Asia/Bangkok");

        $managementRuas = DB::table('management_ruas')->where('ruas_id','!=',0)->orderBy('ruas_name','ASC')->get();
        $managementJenisKendala = DB::table('management_jenis_kendala')->get();


        return view('cso.dashboard',['managementRuas' => $managementRuas, 'managementJenisKendala' => $managementJenisKendala]);
    }
    
    //ajax
    public function LoadLaporanCso(){
        date_default_timezone_set("Asia/Bangkok");

        $list_laporan = DB::table('list_laporan')
                        ->selectRaw('*, list_laporan.status_id as status, c.username as creator, m.username as mediumCreator, h.username as highCreator')
                        ->leftjoin('management_ruas', 'list_laporan.laporan_ruas_id','=','management_ruas.ruas_id')
                        ->leftjoin('management_jenis_kendala', 'list_laporan.laporan_problem_category','=','management_jenis_kendala.kendala_id')
                        ->leftjoin('status_priority_preference', 'list_laporan.laporan_priority_status_id','=','status_priority_preference.priority_id')
                        ->leftjoin('status_laporan_reference','list_laporan.status_id','=','status_laporan_reference.status_id')
                        ->leftjoin('user_management as c','list_laporan.created_by','=','c.user_id')
                        ->leftjoin('user_management as m','list_laporan.medium_created_by','=','m.user_id')
                        ->leftjoin('user_management as h','list_laporan.high_created_by','=','h.user_id')
                        ->orderByRaw('FIELD(status ,5,6) ASC')
                        ->orderByDesc('priority_id')
                        ->orderBy('laporan_created_timestamp')
                        ->get();

        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function addLaporan(Request $request){
        date_default_timezone_set("Asia/Bangkok");

        $csoId = Session::get('npp');
        $string = date('Y-m-d H:i:s').$request->no_hp;

        List_Laporan::create([
            'laporan_name'              => $request->nama,
            'laporan_phone_no'          => $request->no_hp,
            'laporan_vehicle_category'  => $request->jenis_mobil,
            'laporan_problem_category'  => $request->jenis_kendala,
            'laporan_plat_no'           => $request->plat_nomor,
            'laporan_ruas_id'           => $request->ruas,
            'laporan_jalur'             => $request->jalur,
            'laporan_description'       => $request->keterangan,
            'laporan_km'                => $request->km,
            'blast_url'                 => env('ENV_BLAST_URL').hash("md5",$string),
            'status_id'                 => 1,
            'cso_id'                    => $csoId,
            'laporan_priority_status_id'=> 1,
            'laporan_created_timestamp' => date('Y-m-d H:i:s'),
            'created_by'                => Session::get('user_id')
        ]);
        
        return response()->json(['status' =>true, 'data' => null ]);
    }

    public function editLaporan(Request $request){
        date_default_timezone_set("Asia/Bangkok");

        // dd($request);
        DB::table('list_laporan')->where('laporan_id',$request->laporanid)
                ->update([
                    'laporan_name'              => $request->editnama,
                    'laporan_phone_no'          => $request->editno_hp,
                    'laporan_vehicle_category'  => $request->editjenis_mobil,
                    'laporan_problem_category'  => $request->editjenis_kendala,
                    'laporan_plat_no'           => $request->editplat_nomor,
                    'laporan_ruas_id'           => $request->editruas,
                    'laporan_jalur'             => $request->editjalur,
                    'laporan_description'       => $request->editketerangan,
                    'laporan_km'                => $request->editkm,
                    'updated_at'                => date('Y-m-d H:i:s')
                ]);
        
        return response()->json(['status' =>true, 'data' => null ]);
    }

    public function changePriority(Request $request){
        date_default_timezone_set("Asia/Bangkok");

        $currentPriority = $request->priorityid;

        if ($currentPriority == 1){
            DB::table('list_laporan')->where('laporan_id',$request->laporanid)
            ->update([
                'laporan_priority_status_id'                => 2,
                'laporan_medium_priority_created_timestamp' => date('Y-m-d H:i:s'),
                'updated_at'                                => date('Y-m-d H:i:s'),
                'medium_created_by'                         => Session::get('user_id')
            ]);
        }
        
        if ($currentPriority == 2){
            DB::table('list_laporan')->where('laporan_id',$request->laporanid)
            ->update([
                'laporan_priority_status_id'=> 3,
                'laporan_high_priority_created_timestamp' => date('Y-m-d H:i:s'),
                'updated_at'                => date('Y-m-d H:i:s'),
                'high_created_by'           => Session::get('user_id')
            ]);
        }
        
        return response()->json(['status' =>true, 'data' => null ]);
    }
}
