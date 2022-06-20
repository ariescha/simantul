<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management_Jenis_Kendala extends Model
{
    protected $table = 'management_jenis_kendala';
    protected $primaryKey = 'kendala_id';
    //public $timestamps = false;
    protected $fillable = ['kendala_id','kendala'];
}