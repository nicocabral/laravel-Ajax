<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use Validator;
use App\Http\Helpers\LogsHelper;
class SettingController extends Controller
{
    //

    public function index(){
    	return view('dashboard.settings.index');
    }

    public function store(Request $request){
    	$message = ['defaultresultcode.required' => 'Please select atleast 1 Default result code values'];
    	$validate = Validator::make($request->all(),['defaultresultcode'=>'required'],$message);
    	if($validate->fails()){
    		return response()->json(['success'=>false,'message'=>'Please select atleast 1 Default result code values']);
    	}
    	$setting =  new Setting;
    	$setting->merchantid = Auth::user()->merchantid;
    	$setting->defaultnoofmaxfailures = $request['no_of_failures'];
    	$setting->defaultnoofmaxintervals= $request['no_of_failures_intervals'];
    	$setting->defaultcoderesult = $request['defaultresultcode'];
    	$setting->save();
        $log = new LogsHelper();
        $log->store('store','Security Question '.Auth::user()->name);
    	return $setting ? response()->json(['success'=>true,'message'=>'Settngs save']):response()->json(['success'=>false,'message'=>'An error occured, unable to process your request']);
    }
    public function show(){
    	$id = Auth::user()->merchantid;
    	$setting = Setting::whereMerchantid($id)->first();
    	if($setting){
    		return $setting->defaultcoderesult;
    	}

    	
    }
}
