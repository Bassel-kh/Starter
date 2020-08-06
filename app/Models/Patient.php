<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'name', 'age'];// important for update and insert
    protected  $hidden = [];
    public $timestamps = false; // the timestamps will not insert to table

    public function doctor(){
        return $this ->hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id', 'id', 'id');
    }
}
