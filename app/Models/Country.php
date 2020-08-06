<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'name'];// important for update and insert
    protected  $hidden = [];
    public $timestamps = false; // the timestamps will not insert to table

    public function doctors(){
        return $this->hasManyThrough('App\Models\Doctor', 'App\Models\Hospital', 'country_id', 'hospital_id', 'id', 'id');
    }
// task 2
    public function hospitals(){
        return $this -> hasMany('App\Models\Hospital','country_id', 'id');
    }
}
