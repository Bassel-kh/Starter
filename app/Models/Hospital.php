<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = "hospitals"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'name', 'address','created_at', 'updated_at', 'country_id'];// important for update and insert
    protected  $hidden = ['created_at', 'updated_at'];
    public $timestamps = true; // the timestamps will not insert to table

    public function doctors(){
        return $this -> hasMany('App\Models\Doctor','hospital_id','id');
    }
}
