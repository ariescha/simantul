<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapitulasiAdminController extends Controller
{
    public function index(){
        return view('admin.rekapitulasi-admin');
    }
}
