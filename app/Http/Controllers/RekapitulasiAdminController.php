<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_Laporan;
use App\Models\Management_Ruas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;

class RekapitulasiAdminController extends Controller
{
    public function index(){
        return view('admin.rekapitulasi-admin');
    }
    // public function PilihRegion(request $request){
    //     LoadChart($request->area);
    // }
    public function LoadRekapitulasi($id){
        date_default_timezone_set("Asia/Bangkok");
        if($id == 0){
            $list_laporan = DB::table('list_laporan')
                        ->selectraw("count(distinct laporan_id) as cnt_diterima, count(distinct case when laporan_forward_to_tic_timestamp is not null then laporan_id end) as cnt_diteruskan, count(distinct case when data_petugas_id is not null then laporan_id end) as cnt_ditindak")
                        ->get();
        }else{
            $a_start = date("Y-m-d H:i:s", strtotime($id." 00:00:00"));
            $a_end = date("Y-m-d H:i:s", strtotime($id." 23:59:00"));
            $list_laporan = DB::table('list_laporan')->whereBetween('laporan_created_timestamp',[$a_start,$a_end])
                        ->selectraw("count(distinct laporan_id) as cnt_diterima, count(distinct case when laporan_forward_to_tic_timestamp is not null then laporan_id end) as cnt_diteruskan, count(distinct case when data_petugas_id is not null then laporan_id end) as cnt_ditindak")
                        ->get();
        }
        
        // dd($list_laporan);
        return response()->json(['status' => true, 'data' => $list_laporan]);
    }

    public function ExportExcel(Request $request){
        $a = 0;
        if ($request->tanggal == null){
            $a = 0;
        }
        else{
            $a = $request->tanggal;
        }
        return Excel::download(new RekapExport($a), 'Rekapitulasi.xlsx');
    }
    public function LoadChart($id){
        $area_1 = [1,2,3,4,5,6,7,8,9,10,11];
        $area_2 = [12,13,14,15,16,17,18,19,20,21,22,23,24];
        $area_3 = [25,26,27,28];
        if($id == 1){
            foreach($area_1 as $val1){
                $ruas_temp = Management_Ruas::where('ruas_id',$val1)->select('ruas_name')->first();
                $ruas[] = $ruas_temp->ruas_name;
                $data_req[] = count(List_Laporan::where('laporan_ruas_id',$val1)->where('status_id','<>',5)->get());   
                $data_done[] = count(List_Laporan::where('laporan_ruas_id',$val1)->where('status_id',5)->get());
            }
            foreach($data_req as $k1 => $v1){
                if($data_done[$k1]+$v1== 0){
                    
                    $persentase[] = 0;
                }
                else{
                    $persentase[] = round(($data_done[$k1]/($data_done[$k1]+$v1))*100);
                }
            }
        }
        else if($id == 2){
            foreach($area_2 as $val2){
                $ruas_temp = Management_Ruas::where('ruas_id',$val2)->select('ruas_name')->first();
                $ruas[] = $ruas_temp->ruas_name;
                $data_done[] = count(List_Laporan::where('laporan_ruas_id',$val2)->where('status_id','<>',5)->get());
                $data_req[] = count(List_Laporan::where('laporan_ruas_id',$val2)->where('status_id','!=',5)->get());   
            }
            foreach($data_req as $k2 => $v2){
                if($data_done[$k2]+$v2== 0){
                    $persentase[] = 0;
                }else{
                    $persentase[] = round($data_done[$k2]/($data_done[$k2]+$data_req[$k2])*100);
                }
            }
        }else{
                foreach($area_3 as $val3){
                    $ruas_temp = Management_Ruas::where('ruas_id',$val3)->select('ruas_name')->first();
                    $ruas[] = $ruas_temp->ruas_name;
                    $data_req[] = count(List_Laporan::where('laporan_ruas_id',$val3)->where('status_id','!=',5)->get());   
                    $data_done[] = count(List_Laporan::where('laporan_ruas_id',$val3)->where('status_id',5)->get());
                }
                foreach($data_req as $k3 => $v3){
                    if($data_done[$k3]+$v3== 0){
                        $persentase[] = 0;
                    }
                    else{
                        $persentase[] = round($data_done[$k3]/($data_done[$k3]+$data_req[$k3])*100);
                    }
                }
        }

        $data = array($data_req,$data_done,$persentase,$ruas);
        return response()->json(['status' => true, 'data' => $data]);
        
    }
}
