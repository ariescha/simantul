<?php

namespace App\Http\Controllers;
use App\Models\User_Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index($id){
        date_default_timezone_set("Asia/Bangkok");
        return view('auth.login')->with('id',$id);
    }

    public function loginpost(request $request){
        date_default_timezone_set("Asia/Bangkok");
        $npp = $request->npp;
        $password = $request->password;
        $shift = $request->shift;

        $user = User_Management::whereRaw('npp = ?', [$npp])->first();
        if($user){
            if($password == $user->password){
                Session::put('npp',$npp);
                Session::put('ruas',$user->ruas);
                Session::put('username',$user->username);
                Session::put('role',$request->role_id);
                Session::put('user_id',$user->user_id);
                if($user->role == 1 && $request->role_id == 1){
                    return redirect('dashboard-cso');
                }else if($user->role == 2 && $request->role_id == 2){
                    return redirect('dashboard-command-center');
                }else if($user->role == 3 && $request->role_id == 3){
                    return redirect('dashboard-tic-area');
                }else if($user->role == 4 && $request->role_id == 4){
                    return redirect('dashboard-admin');
                }else{
                    $role = array("","CSO","Command Center","TIC Area","Admin");
                    $alert = "Akses ditolak! Anda tidak memiliki hak akses sebagai ".$role[$request->role_id];
                    return back()->with('alert',$alert);
                }
            }
            else{
                return back()->with('alert','Password salah! Mohon periksa kembali.'); 
            }
        } else{
            return back()->with('alert','Akun tidak ditemukan.');
        }
    }

    public function logout(){
        date_default_timezone_set("Asia/Bangkok");
        Session::flush();
        return redirect('');
    }
}
