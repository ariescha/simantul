<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'role_id';
    //public $timestamps = false;
    protected $fillable = ['role_id','role'];
}