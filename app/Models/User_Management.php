<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Management extends Model
{
    protected $table = 'user_management';
    protected $primaryKey = 'user_id';
    //public $timestamps = false;
    protected $fillable = ['user_id','username','password','npp','role','ruas'];
}