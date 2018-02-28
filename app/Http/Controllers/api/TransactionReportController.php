<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionReportController extends Controller
{
    //

    public function index(){
    	return view('dashboard.transaction_reports.index');
    }
}
