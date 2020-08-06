<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $table = "medicals"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'pdf', 'patient_id'];// important for update and insert
    protected  $hidden = [];
    public $timestamps = false; // the timestamps will not insert to table
}
