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

    public function store($request,$mid){
    	try{
                if(!empty($request['role'])){
                    session(['role'=>$request['role'],'permission'=>$request['permission']]);
                }
                else{
                    session(['role'=>2,'permission'=>1]);
                }
                $user = new User;
                $user->merchantid = $mid;
                $user->name = $request['name'];
                $user->dob = $request['dob'];
                $user->email = $request['email'];
                $user->password = bcrypt($request['password']);
                $user->role = session('role');
                $user->permission = session('permission');
                $user->status = 2;
                $user->save();
                if($user){
                    session()->forget(['role','permission']);
                }
        
               
    	}catch(\Exception $e){
    		return response()->json(['fail' => true, 'message'=>$e->getMessage()]);
    	}
    }

    public function updatePassword($request){
    	$update = User::whereMerchantid($request['id'])
    	->update(['password' => bcrypt($request['password']), 'status' => 2]);

    }

    public function destroy($id){
    	$user = User::whereMerchantid($id)->update(['deleted_at'=>Carbon::now('Asia/Manila'),'status'=>0]);
    }
}
