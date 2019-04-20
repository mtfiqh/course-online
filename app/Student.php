<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //fillable
    protected $fillable= [
        'user_id',
    ];
}
