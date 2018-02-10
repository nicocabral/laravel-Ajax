<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use App\User;
use Validator;
use DB;
use Carbon\Carbon;
class UserController extends Controller
{
    //
    public function index(){
    	return view('dashboard.merchants.index');
    }
}
