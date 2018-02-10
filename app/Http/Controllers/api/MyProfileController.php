<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Validator;
class MyProfileController extends Controller
{
    //

    public function index(){
    	return view('dashboard.myprofile.index');
    }

    public function update(Request $request){
    	$id = Auth::user()->id;
    	$message = ['name.required' => 'Name is required',
    				'dob.required' =>'Birthdate is required',
    				'email.required' => 'Email is required'];
    	$validator = Validator::make($request->all(),['name'=>'required',
    												  'dob' =>'required',
    												  'email' => 'required|unique:users,email,'.$id],$message);
    	if($validator->fails()){
    		 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    	}
    	$myprofile = User::whereId($id)->update(['name'=>$request['name'],
    											'dob' => $request['dob'],
    											'email' => $request['email']]);
    	return $myprofile ? response()->json(['success'=>true, 'message'=>'Profile updated']) : response()->json(['success'=>false, 'message'=>'An error occured while updating your profile']);
    }

    public function updatePassword(Request $request){
    	$id = Auth::user()->id;
    	$message = ['newpassword.required' => 'Name is required',
    				'confirmpassword.required' =>'Birthdate is required',
    				];
    	$validator = Validator::make($request->all(),['newpassword'=>'required|same:confirmpassword|min:8',
    												  'confirmpassword' =>'required|same:newpassword|min:8',
    												  ],$message);
    	if($validator->fails()){
    		 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    	}
    	$updatepassword = User::whereId($id)->update(['password'=>bcrypt($request['confirmpassword'])]);
    	return $updatepassword ? response()->json(['success'=>true, 'message'=>'Password updated']) : response()->json(['fail'=>false, 'message'=>'An error occured while updating your password']);
    }
}
