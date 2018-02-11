<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    //
    protected $table = 'customer_contacts';
    protected $fillable = ['d_phone','e_phone','m_phone','fax','customerid'];
}
