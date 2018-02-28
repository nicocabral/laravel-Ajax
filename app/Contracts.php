<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    //
    protected $table = 'contracts';
    protected $fillable = ['customerid','contractid','name','startdate','enddate','subtotal','tax','total','status','paymentitem','contractfrequency','retryprocessing'];
}
