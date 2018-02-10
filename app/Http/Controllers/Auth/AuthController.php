<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use JWTAuthException;
use App\User;
class AuthController extends Controller
{
    //
    public function postLogin(Request $request)
    {
    	try{
    		$token = null;
    		$username = $request['email'];
    		$password = $request['password'];
    		$credentials = ['email' => $username, 'password' => $password];
    		$login = Auth::attempt($credentials);
    		if(count($login)){
    		try{
    			
		    		if(!$token = JWTAuth::attempt($credentials)){
		    				return response()->json(['success'=>false,'message'=>'Invalid  email and/or password']);
		    		}
    			}catch(JWTAuthException $e){
    				return response()->json(['success'=>false,'message'=>'Failed to create token'],404);
    			}
    			return response()->json(['success'=>true,'token'=>$token],200);
    		}
    		return response()->json(['success'=>false,'message'=>'Invalid  email and/or password']);
    		}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}

    }
}
