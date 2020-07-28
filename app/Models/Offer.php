<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
//    protected $table = "my_offers"; // use this when Model_name != Table_name in database
    protected  $fillable =['name_ar', 'name_en', 'price', 'details_ar', 'details_en','created_at', 'updated_at'];// important for update and insert
    protected  $hidden = ['created_at', 'updated_at'];
    public $timestamps = false; // the timestamps will not insert to table
}
