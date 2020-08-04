<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $table = "phone"; // use this when Model_name != Table_name in database
    protected  $fillable =['id', 'cod', 'phone', 'user_id'];// important for update and insert
    protected  $hidden = ['user_id'];
    public $timestamps = false; // the timestamps will not insert to table

    ############################ Begin relations ##################################
    public  function user(){
        return @$this -> belongsTo('App\User','user_id');
    }

    ############################ End relations ##################################

}
