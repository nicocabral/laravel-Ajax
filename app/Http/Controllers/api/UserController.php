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
use App\Http\Helpers\LogsHelper;
class UserController extends Controller
{
    //
    public function index(){
    	return view('dashboard.merchants.index');
    }

    public function store($request,$mid){
    	try{
              
                $user = new User;
                $user->merchantid = $mid;
                $user->name = $request['name'];
                $user->dob = $request['dob'];
                $user->email = $request['email'];
                $user->password = bcrypt($request['password']);
                $user->role = 2;
                $user->permission = 1;
                $user->status = 2;
                $user->save();
                if($user){

                    $log = new LogsHelper();
                    $log->store('store','Created'.$request['name']);
                    session()->forget(['role','permission']);
                }
        
               
    	}catch(\Exception $e){
    		return response()->json(['fail' => true, 'message'=>$e->getMessage()]);
    	}
    }

     

    public function updatePassword($request){
    	$update = User::whereMerchantid($request['id'])
    	->update(['password' => bcrypt($request['password']), 'status' => 2]);
        $log = new LogsHelper();
        $log->store('Update password','Update'.$request['id']);

    }

    public function destroy($id){
        $log = new LogsHelper();
        $log->store('Deleted',$id);
    	$user = User::whereMerchantid($id)->update(['deleted_at'=>Carbon::now('Asia/Manila'),'status'=>0]);
    }
}
