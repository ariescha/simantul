<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_Laporan;
class RekapitulasiAdminController extends Controller
{
    public function index(){
        return view('admin.rekapitulasi-admin');
    }
    // public function PilihRegion(request $request){
    //     LoadChart($request->area);
    // }
    public function LoadChart($id){
        $area_1 = [1,3];
        $area_2 = [2,6];
        $area_3 = [4,5];
        if($id = 1){
            foreach($area_1 as $val){
                $data_all[] = count(List_Laporan::where('laporan_ruas_id',$val)->get());   
                $data_done[] = count(List_Laporan::where('laporan_ruas_id',$val)->where('status_id',5)->get());
            }
            foreach($data_all as $key => $val){
                $persentase[] = $data_done[$key]/$data_all[$key]*100;
            }
        }

        $data = array($data_all,$data_done,$persentase);
        return response()->json(['status' => true, 'data' => $data]);
        
    }
}
