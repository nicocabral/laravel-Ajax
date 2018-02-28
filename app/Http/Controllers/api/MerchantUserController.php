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
use App\MerchantUser;
use App\Merchant;
use App\User;
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Helpers\EmailHelper;
use App\Http\Helpers\LogsHelper;
class MerchantUserController extends Controller
{
    //
    public function index(){
    	return view('dashboard.users.index');
    }


    public function apiUsers(){
    	$id = Auth::id();
        $merchant = DB::table('users')
        ->select('users.*', 'merchant_users.locationid', 'merchant_users.location_name', 'merchant_users.branchid', 'merchant_users.branch_name')
        ->join('merchant_users','merchant_users.userid','=','users.id')
        ->where('users.merchantid','!=',Null)
        ->where('users.role', '!=', 2)
        ->where('users.role', '!=', 1)
        ->where('users.id','!=',$id)->get();
    	return DataTables::of($merchant)->make(true);
    }
    public function store(Request $request){
    	try{

    		$message = ['name.required' => 'Name is required',
    					'email.required' => 'Email is required',
    					'dob.required' => 'Birthdate is required'];
    		$validator = Validator::make($request->all(),['name' => 'required',
    													  'email' => 'required|unique:users,email',
    													  'dob'=>'required'],$message);
    		if($validator->fails()){
    		return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
            if(Auth::user()->role == 2){
                $password = $this->randomPassword();
                $user = new User;
                $user->merchantid = Auth::user()->merchantid;
                $user->name = $request['name'];
                $user->dob = $request['dob'];
                $user->email = $request['email'];
                $user->password = bcrypt($password);
                $user->contact = $request['contact'];
                $user->role = 3;
                $user->permission = 1;
                $user->status = 2;
                $user->save();
                if($user){
                    $merchant = new MerchantUser;
                    $merchant->userid = $user->id;
                    $merchant->save();
                    $mail = new EmailHelper;
                    $mail->sendCredentials($request['email'],$password);
                    $log = new LogsHelper();
                    $log->store('store','Created '.$request['name']);
                    return response()->json(['success'=>true,'message'=>'User created']);
                }
                
            return response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);
            }
            else{

                $insert = $this->storeMerchantUsers($request->all());
                $log = new LogsHelper();
                $log->store('store','Created '.$request['name']);
                return $insert == 1 ? response()->json(['success'=>true,'message'=>'User created']) : response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);
            }
        		


    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
            
    }

    public function destroy($id){
    	try{
    		$user = User::whereId($id)->update(['deleted_at'=>Carbon::now('Asia/Manila'), 'status'=>0]);
    		if($user){
                $log = new LogsHelper();
                $log->store('Delete','Deleted '.$id);
    			return response()->json(['success'=>true,'message'=>'User deleted']);
    		}
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);	
    	}
    }

    public function edit($id){
    	$merchant = User::find($id);
    	return $merchant;
    }
    public function update(Request $request,$id){
    	try{
    		$message = ['name.required' => 'Name is required',
    					'email.required' => 'Email is required',
    					'dob.required' => 'Birthdate is required'];
    		$validator = Validator::make($request->all(),['name' => 'required',
    													  'email' => 'required|unique:merchants,email,'.$id,
    													  'dob'=>'required'],$message);
    		if($validator->fails()){
    		return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
    		$merchant = User::whereId($id)->update(['name' => $request['name'],
    													'dob' => $request['dob'],
    													'contact' => $request['contact'],
    													'email' => $request['email']]);
            $log = new LogsHelper();
            $log->store('Updated','Updated '.$request['name']);
    		return $merchant ? response()->json(['success'=>true,'message'=>'User updated']) : response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }

    public function resetPassword(Request $request){
    	try{
    		$merchant = User::whereId($request['id'])
    		->update(['password' => bcrypt($request['password']),'status' => 2]);
    		$mail = new EmailHelper;
    		$mail->sendCredentials($request['email'],$request['password']);
            $log = new LogsHelper();
            $log->store('resetpassword',$request['name']);
    		return $merchant ? response()->json(['success'=>true,'message'=>"Password sent to user's email."]) : response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    	

    }
     public function randomPassword(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&*?';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

 function storeMerchantUsers($request){
                $password = $this->randomPassword();
                $user = new User;
                $user->merchantid = Auth::user()->merchantid;
                $user->name = $request['name'];
                $user->dob = $request['dob'];
                $user->email = $request['email'];
                $user->password = bcrypt($password);
                $user->contact = $request['contact'];
                $user->role = $request['role'];
                $user->permission = $request['permission'];
                $user->status = 2;
                $user->save();
                if($user){
                    $merchant = new MerchantUser;
                    $merchant->userid = $user->id;
                    $merchant->save();
                    $mail = new EmailHelper;
                    $mail->sendCredentials($request['email'],$password);
                    $result = [1];
                    return implode($result);
                }
                $result = [2];
                
                return implode($result);
 }
}
