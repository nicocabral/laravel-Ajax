<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SecurityQuestion;
use Validator;
use Carbon\Carbon;
class SecurityQuestionController extends Controller
{
    //
    public function show(){
    	$id = Auth::user()->id;
    	$data = SecurityQuestion::whereUserid($id)->first();
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
    	$data = new SecurityQuestion;
    	$data->userid = $id;
    	$data->question = $request['question'];
    	$data->answer = $request['answer'];
    	$data->status = 1;
    	$data->save();
    	return $data ? response()->json(['success'=>true,'message'=>'Security Question created']) : response()->json(['fail'=>true,'message'=>'An error occured while saving your security question']);

    }
}
