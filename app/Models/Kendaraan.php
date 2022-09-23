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


    public function ruas()
    {
        return $this->belongsTo('App\Models\Management_Ruas','ruas_id');
    }

    public function jenis_kendaraan()
    {
        return $this->belongsTo('App\Models\Management_Jenis_Kendaraan','kendaraan_jenis');
    }
}