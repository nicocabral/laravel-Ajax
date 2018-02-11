<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\SecurityQuestion;
use App\Http\Helpers\EmailHelper;
class ForgotPasswordController extends Controller
{
    //
    public function verifyEmail(Request $request){
    	try{

    		$verify = User::whereEmail($request['email'])->first();
    		if(count($verify)){
    			$sq = SecurityQuestion::whereUserid($verify->id)->first();
    			if($sq){
    				session('email', $request['email']);
    				return response()->json(['question' =>$sq->question]);
    			}
    			return response()->json(['success' => false,'message'=> 'This email have no security question, unable to continue. Please contact your system administrator']);
    			
    		}
    		return response()->json(['success' =>false, 'message' => 'Email does not exist in the database']);

    	}catch(\Exception $e){
    		return response()->json(['fail' => true,'message'=>$e->getMessage()]);
    	}
    }

    public function resetPassword(Request $request){
    	try{
    		
    		$user = User::whereEmail($request['email'])->first();
    		$password = $this->randomPassword();
    		$update = User::whereId($user->id)->update(['password' => bcrypt($password),'status' => 2]);
    		if($update){
    			$mail = new EmailHelper;
    			$mail->sendCredentials($request['email'],$password);
    			return response()->json(['success'=>true,'message'=>'Password reset successfully. Please check your email. Thank you!']);
    		}
    		return response()->json(['success' => false,'message'=>'An error occured while resetting your password. Please try again']);
    	}catch(\Exception $e){
    		return response()->json(['fail' => true,'message'=>$e->getMessage()]);
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
}
