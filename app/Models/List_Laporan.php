<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Laporan extends Model
{
    protected $table = 'list_laporan';
    protected $primaryKey = 'laporan_id';
    //public $timestamps = false;
    protected $fillable = ['laporan_id','laporan_created_timestamp','laporan_closed_timestamp','laporan_name','laporan_phone_no',
                            'laporan_vehicle_category','laporan_problem_category','laporan_plat_no','laporan_ruas_id',
                            'laporan_jalur','laporan_description','status_id','cso_id','command_center_id','tic_id','laporan_foward_to_tic_timestamp',
                            'laporan_foward_to_petugas_timestamp','laporan_priority_status_id','laporan_medium_priority_created_timestamp',
                            'laporan_high_priority_created_timestamp','data_petugas_id','laporan_km','blast_url', 'created_by', 'medium_created_by', 'high_created_by'];

    public function creator(){
        return $this->belongsTo('App\Models\User_Management', 'created_by', 'user_id');
    }
    public function mediumCreator(){
        return $this->belongsTo('App\Models\User_Management', 'medium_created_by', 'user_id');
    }
    public function highCreator(){
        return $this->belongsTo('App\Models\User_Management', 'high_created_by', 'user_id');
    }
}