<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractExpirationController extends Controller
{
    //
    public function index(){
    	return view('dashboard.contract_expiration.index');
    }
}
