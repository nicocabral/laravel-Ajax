<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardExpirationController extends Controller
{
    //

    public function index(){
    	return view('dashboard.card_expiration.index');
    }
}
