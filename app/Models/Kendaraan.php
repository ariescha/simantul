<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'kendaraan_id';
    //public $timestamps = false;
    protected $fillable = ['kendaraan_id','kendaraan_jenis','kendaraan_nomor','ruas_id'];
}