<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCompany extends Model
{
    //
    protected $table = 'customer_companies';
    protected $fillable = ['customerid','name','title','department'];
}
