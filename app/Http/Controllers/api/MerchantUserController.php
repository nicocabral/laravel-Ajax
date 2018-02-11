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
use App\Merchant;
use App\User;
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Helpers\EmailHelper;
use App\Http\Controllers\api\UserController;
class MerchantUserController extends Controller
{
    //
    public function index(){
    	return view('dashboard.users.index');
    }


    public function apiUsers(){
    	$id = Auth::user()->merchantid;
    	$query = Merchant::whereId($id)->first();
    	$mid = $query->userid;
    	$merchant = Merchant::whereUserid($mid)
    						->where('id','!=',$id)->get();
    	return DataTables::of($merchant)->make(true);
    }
    public function store(Request $request){
    	try{
    		$message = ['name.required' => 'Name is required',
    					'email.required' => 'Email is required',
    					'dob.required' => 'Birthdate is required'];
    		$validator = Validator::make($request->all(),['name' => 'required',
    													  'email' => 'required|unique:merchants,email',
    													  'dob'=>'required'],$message);
    		if($validator->fails()){
    		return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
    		$query = Merchant::whereId(Auth::user()->merchantid)->first();
    		$userid = $query->userid;
    		$merchant = new Merchant;
    		$merchant->userid = $userid;
    		$merchant->name = $request['name'];
    		$merchant->email = $request['email'];
    		$merchant->dob = $request['dob'];
    		$merchant->contact = $request['contact'];
    		$merchant->password = bcrypt($request['password']);
    		$merchant->role = $request['role'];
    		$merchant->permission = $request['permission'];
    		$merchant->status = 2;
    		$merchant->save();
    		$mail = new EmailHelper;
    		$mail->sendCredentials($request['email'],$request['password']);
    		if($merchant){
    			$mid = $merchant->id;
    			$user = new UserController;
    			$user->store($request->all(),$mid);
    			return response()->json(['success'=>true,'message'=>'User created']);
    		}
    		return response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);


    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }

    public function destroy($id){
    	try{
    		$merchant = Merchant::whereId($id)->update(['deleted_at'=>Carbon::now('Asia/Manila'), 'status'=>0]);
    		$user = User::whereMerchantid($id)->update(['deleted_at'=>Carbon::now('Asia/Manila'), 'status'=>0]);
    		if($merchant && $user){
    			return response()->json(['success'=>true,'message'=>'User deleted']);
    		}
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);	
    	}
    }

    public function edit($id){
    	$merchant = Merchant::find($id);
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
    		$merchant = Merchant::whereId($id)->update(['name' => $request['name'],
    													'dob' => $request['dob'],
    													'contact' => $request['contact'],
    													'email' => $request['email'],
    													'role' => $request['role'],
    													'permission' => $request['permission']]);
    		return $merchant ? response()->json(['success'=>true,'message'=>'User updated']) : response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }

    public function resetPassword(Request $request){
    	try{
    		$merchant = Merchant::whereId($request['id'])
    		->update(['password' => bcrypt($request['password']),'status' => 2]);
    		$mail = new EmailHelper;
    		$mail->sendCredentials($request['email'],$request['password']);
    		return $merchant ? response()->json(['success'=>true,'message'=>"Password sent to user's email."]) : response()->json(['fail'=>true,'message'=>'An error occured, unable to process you request']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    	

    }
}
