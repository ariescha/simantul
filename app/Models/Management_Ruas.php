<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management_Ruas extends Model
{
    protected $table = 'management_ruas';
    protected $primaryKey = 'ruas_id';
    //public $timestamps = false;
    protected $fillable = ['ruas_id','ruas_name'];
}