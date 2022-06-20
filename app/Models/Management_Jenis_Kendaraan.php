<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management_Jenis_Kendaraan extends Model
{
    protected $table = 'management_jenis_kendaraan';
    protected $primaryKey = 'jenis_kendaraan_id';
    //public $timestamps = false;
    protected $fillable = ['jenis_kendaraan_id','jenis_kendaraan'];
}