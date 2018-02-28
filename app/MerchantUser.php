<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantUser extends Model
{
    //
    protected $table = 'merchant_users';
     protected $fillable = ['merchantid','name','dob','contact','email','password','role','permission','status'];
}
