<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'name', 'title','hospital_id','created_at', 'updated_at','medical_id'];// important for update and insert
    protected  $hidden = ['created_at', 'updated_at','pivot'];
    public $timestamps = true; // the timestamps will not insert to table

    public function hospital(){
        return $this -> belongsTo('App\Models\Hospital','hospital_id','id');
    }
    public function services(){
        return $this -> belongsToMany('App\Models\Service','doctor_services','doctor_id','service_id','id','id');
    }

        // accessors
    public function  getGenderAttribute($val){
        return $val == 1? 'male':'female';
    }

        // mutators

}
