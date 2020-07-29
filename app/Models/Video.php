<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "videos"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'name', 'viewers', 'videoLink'];// important for update and insert
    protected  $hidden = ['videoLink'];
    public $timestamps = false; // the timestamps will not insert to table
}
