<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable= [
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function certificates(){
        return $this->hasMany('App\Certificate');
    }
}
