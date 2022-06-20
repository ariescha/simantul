<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_Laporan_Reference extends Model
{
    protected $table = 'status_laporan_reference';
    protected $primaryKey = 'status_id';
    //public $timestamps = false;
    protected $fillable = ['status_id','status_name'];
}