<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    //

    public function index(){
    	return view('dashboard.contracts.index');
    }
}
