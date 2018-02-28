<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    //
    protected $table = 'user_logs';
    protected $fillable = ['userid','user_name','action','details','others'];
}
