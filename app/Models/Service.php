<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'name','created_at', 'updated_at'];// important for update and insert
    protected  $hidden = ['created_at', 'updated_at','pivot'];
    public $timestamps = false; // the timestamps will not insert to table

    public function doctors(){
        return $this -> belongsToMany('App\Models\Doctor','doctor_services','service_id','doctor_id','id','id');
    }
}
