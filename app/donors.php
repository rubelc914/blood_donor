<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class donors extends Model
{
    //
    protected $table = 'donors';
    protected $fillable = ['name', 'age','weight','phone','gender','address','password'];
}
