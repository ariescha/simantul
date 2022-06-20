<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management_Karyawan extends Model
{
    protected $table = 'management_karyawan';
    protected $primaryKey = 'karyawan_id';
    //public $timestamps = false;
    protected $fillable = ['karyawan_id','npp','nama','kategori_petugas','ruas_id'];
}