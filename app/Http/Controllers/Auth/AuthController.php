<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use JWTAuthException;
use App\User;
use App\Log;
use Session;
class AuthController extends Controller
{
    //
    public function postLogin(Request $request)
    {
    	try{
            $check = User::whereEmail($request['email'])->first();
            if($check){
                if($check->status== 0){
                    return response()->json(['fail'=>true,'message'=>'Account '.$check->email.' is Locked']);
                }

            if(Session::get('attempt') == 3){
                $user = User::whereEmail($request['email'])->update(['status'=>0]);
                Session::forget('attempt');
                return response()->json(['success'=>false,'message'=>'Account '.$request['email'].' is Locked','attemp'=>3]);
            }

            $attemp = 0;
    		$token = null;
    		$username = $request['email'];
    		$password = $request['password'];
    		$credentials = ['email' => $username, 'password' => $password];
            $value = Session::get('attempt');
    		
    		try{
    			
		    		if(!$token = JWTAuth::attempt($credentials)){
                        $value++;    
                        Session::put('attempt',$value);
                       
		    				return response()->json(['success'=>false,'message'=>'Invalid  email and/or password','attemp'=>$value]);
		    		}
    		}catch(JWTAuthException $e){
    				return response()->json(['success'=>false,'message'=>'Failed to create token'],404);
    			}
                $log = new Log;
                $log->userid = Auth::id();
                $log->save();
                Session::forget('attempt');
                $login = Auth::attempt($credentials);
    		    return $login ? response()->json(['success'=>true,'token'=>$token],200) : response()->json(['success'=>false,'message'=>'Invalid  email and/or password','attemp'=>$value]);;
    		
              }else{
                return response()->json(['fail'=>true,'message'=>'Email does not exist']);
              }
    		}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}

    }
}
