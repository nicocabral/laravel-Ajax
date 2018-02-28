<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingReportController extends Controller
{
    //
    public function index(){
    	return view('dashboard.billingreports.index');
    }
}
