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
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Helpers\EmailHelper;
class MerchantController extends Controller
{
    //
     public function index(){
    	return view('dashboard.merchants.index');
    }

    public function store(Request $request){
    	try{
    		$message = ['name.required' => 'Name is required',
    					'dob.required' => 'Birthdate is required',
    					'email.required' => 'Email is required',
    					'contact.required' => 'Contact is required',
    					'status.required' => 'Status is required',
    					'password.required'=>'Password is required'];
    		$validator = Validator::make($request->all(),['name'=>'required',
    													  'dob' => 'required',
    													  'contact' => 'required',
    													  'email' => 'required|unique:merchants|email',
    													  'status' => 'required',
    													  'password'=>'required'],$message);
    		if($validator->fails()){
    			 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
    		$merchant = new Merchant;
    		$merchant->userid = Auth::id();
    		$merchant->name = $request['name'];
    		$merchant->dob = $request['dob'];
    		$merchant->email = $request['email'];
    		$merchant->contact = $request['contact'];
    		$merchant->status = 2;
    		$merchant->password = bcrypt($request['password']);
    		$merchant->role = 2;
    		$merchant->permission = 1;
    		$merchant->save();
    		if($merchant){
    			$sendMail = new EmailHelper;
    			$sendMail->sendCredentials($request['email'],$request['password']);
    			return response()->json(['success'=>true,'message'=>"Merchant Created, credentials sent to merchant's email"]);
    		}
    	
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }


    public function edit($id){
    	$merchant = Merchant::findOrFail($id);
    	return $merchant;
    }

    public function update(Request $request, $id){
    	$message = ['name.required' => 'Name is required',
    					'dob.required' => 'Birthdate is required',
    					'email.required' => 'Email is required',
    					'contact.required' => 'Contact is required',
    					'status.required' => 'Status is required',
    					];
    		$validator = Validator::make($request->all(),['name'=>'required',
    													  'dob' => 'required',
    													  'contact' => 'required',
    													  'email' => 'required|unique:merchants,email,'.$id,
    													  'status' => 'required',
    													  ],$message);
    		if($validator->fails()){
    			 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
    	$merchant = Merchant::whereId($id)->update(['name' => $request['name'],
    												'dob'=> $request['dob'],
    												'contact' => $request['contact'],
    												'email' => $request['email'],
    												'status' => $request['status']]);
    	return $merchant ? response()->json(['success'=>true,'message'=>'Merchant Updated.']) : response()->json(['fail'=>true,'message'=>'An error occured. Unable to update.']);
    }

    public function destroy($id){
    	try{
    		$merchant = Merchant::whereId($id)->update(['deleted_at'=>Carbon::now('Asia/Manila')]);
    		return $merchant ? response()->json(['success'=>true,'message'=>'Deleted successfully']) : " ";
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true, 'message'=>$e->getMessage()]);
    	}
    }
    public function apiMerchant(){
    	try{
    		$id = Auth::id();
    		$merchant = Merchant::whereUserid($id)
    							->whereDeleted_at(null)->get();
    		return DataTables::of($merchant)->make(true);
    	}catch(\Exception $e){
    		return response()->json(['fail' => true,'message'=>$e->getMessage()]);
    	}
    }

    public function resetPassword(Request $request){
    	$update = Merchant::whereId($request['id'])
    	->update(['password' => bcrypt($request['password']), 'status' => 2]);
    	if($update){
    		$merchant = Merchant::findOrFail($request['id']);
	    	$email = $merchant->email;
	    	$password = $request['password'];
	    	$sendEmail = new EmailHelper;
	    	$sendEmail->sendCredentials($email,$password);
	    	return response()->json(['success'=>true,'message'=>"Password updated. Password sent to merchant's email"]);
    	}
    	
    }
}
