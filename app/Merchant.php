<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    //
    protected $table = 'merchants';

    protected $fillable = ['userid','name','dob','contact','email','password','role','permission','status'];
}
