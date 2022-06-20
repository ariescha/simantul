<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Petugas extends Model
{
    protected $table = 'data_petugas';
    protected $primaryKey = 'data_petugas_id';
    //public $timestamps = false;
    protected $fillable = ['data_petugas_id','kendaraan_id','tanggal','shift','npp_petugas_1','npp_petugas_2',
                            'status','created_at','updated_at','created_by','updated_by'];
}