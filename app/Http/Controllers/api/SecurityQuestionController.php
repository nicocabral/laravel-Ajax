<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SecurityQuestion;
use App\User;
use App\Merchant;
use Validator;
use Carbon\Carbon;
class SecurityQuestionController extends Controller
{
    //
    public function show(){
    	$id = Auth::user()->id;
    	$data = SecurityQuestion::whereUserid($id)
    							->where('deleted_at','=',Null)->first();
    	if(count($data)){
    		return $data;
    	}
    	return response()->json(['success'=>false]);
    }

    public function store(Request $request){
    	$id = Auth::user()->id;
    	$message = ['question.required' => 'Question  is required',
    				'answer.required' => 'Answer is required'];
    	$validator = Validator::make($request->all(),['question' => 'required',
    												  'answer' => 'required'],$message);
    	if($validator->fails()){
    		return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    	}
    	$check = SecurityQuestion::find($id);
    	if($check){
    		return response()->json(['fail' => true ,'message' => 'Already have a security question']);
    	}
    	$data = new SecurityQuestion;
    	$data->userid = $id;
    	$data->question = $request['question'];
    	$data->answer = $request['answer'];
    	$data->status = 1;
    	$data->save();
        $checkstat = Auth::user()->status;
        if($checkstat == 2){
            $updatestat = User::whereId(Auth::user()->id)->update(['status'=>1]);
            return response()->json(['success'=>true,'message'=>'Security Question created']);
        }
    	return $data ? response()->json(['success'=>true,'message'=>'Security Question created']) : response()->json(['fail'=>true,'message'=>'An error occured while saving your security question']);

    }

    public function update(Request $request,  $id){
    	$id = Auth::user()->id;
    	$message = ['question.required' => 'Question  is required',
    				'answer.required' => 'Answer is required'];
    				$validator = Validator::make($request->all(),['question' => 'required',
    												  'answer' => 'required'],$message);
    	if($validator->fails()){
    		return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    	}
    	$data = SecurityQuestion::whereUserid($id)
    	->update(['question' => $request['question'], 'answer' => $request['answer']]);
    	return $data ? response()->json(['success'=>true, 'message'=>'Updated successfully']) : response()->json(['fail'=>true, 'message'=>'An error occured while saving your security question']);
    }
}
