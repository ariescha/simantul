<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_Petugas extends Model
{
    protected $table = 'management_petugas';
    protected $fillable = ['nik_petugas','nama_petugas','jenis_petugas','ruas_id'];
}
