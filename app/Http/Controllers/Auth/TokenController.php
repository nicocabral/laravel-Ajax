<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use JWTAuthException;
use App\User;
class TokenController extends Controller
{
    //
    public function refresh(){
    	$token = JWTAuth::getToken();
    	try{
    		$token = JWTAuth::refresh($token);
    		return response()->json(['token' => $token],200);
    	}catch(TokenExpiredException $e){
    		return response()->json(['fail'=>true,'message'=>'Token is expired']);
    	}
    }

    public function invalidate(){
    	$token = JWTAuth::getToken();
    	try{
    		$token = JWTAuth::invalidate($token);
    		Auth::logout();
    		return response()->json(['success'=>true]);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }
}
