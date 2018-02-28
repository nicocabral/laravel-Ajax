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
use App\Customer;
use App\Merchant;
use App\CustomerCompany;
use App\CustomerContact;
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Helpers\EmailHelper;
use App\Http\Hepers\ExportToExcel;
use App\Http\Helpers\CustomerHelper;
use App\Http\Helpers\CustomerContactHelper;
use App\Http\Helpers\CustomerCompanyHelper;
use App\Http\Helpers\LogsHelper;
class CustomerController extends Controller
{
    //
    public function index(){
    	return view('dashboard.customers.index');
    }

    public function store(Request $request){
    	try{
    		$message = ['fname.required' => 'Firstname is required',
    					'lname.required' => 'Lastname is required',
    					'email.required' => 'Email is required',
    					'company.required' => 'Company is required',
    					'customerid.required' => 'Customer ID is required'];
    		$validator = Validator::make($request->all(),['fname'=> 'required',
    													  'lname'=>'required',
    													  'email'=>'required|unique:customers,email',
    													  'company'=>'required',
    													  'customerid' =>'required'],$message);
    		if($validator->fails()){
    			 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
            $crawl = new CustomerHelper();
            $res = $crawl->store($request);
            if($res['Successful']){
                $customer = new Customer;
                $customer->customerid = $request['customerid'];
                $customer->customercode = $res['CustomerCode'];
                $customer->fname = $request['fname'];
                $customer->lname = $request['lname'];
                $customer->email = $request['email'];
                $customer->merchantid = Auth::user()->merchantid;
                $customer->merchant = $request['merchant'];
                $customer->status = $request['status'];
                $customer->save();
                if($customer){
                    $customer_contact = new CustomerContactHelper();
                    $customer_contact->store($request,$customer->customerid);
                    $customer_company = new CustomerCompanyHelper();
                    $customer_company->store($request,$customer->customerid);
                    $log = new LogsHelper();
                    $log->store('store','Created'.$request['fname'].' '.$request['lname']);
                    return response()->json(['success'=>true,'message'=>'Customer created']);
                } 
            }
    		
    		return response()->json(['fail'=>true,'message'=>'An error occured. Unable to create customer.']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }

    public function edit($id){
    	$customer = Customer::find($id);
    	$company = CustomerCompany::whereCustomerid($customer->customerid)->first();
    	$contact = CustomerContact::whereCustomerid($customer->customerid)->first();
    	return response()->json(['customer' => $customer,'company'=>$company, 'contact' => $contact]);
    }

    public function update(Request $request, $id){
    	try{
    		$message = ['fname.required' => 'Firstname is required',
    					'lname.required' => 'Lastname is required',
    					'email.required' => 'Email is required',
    					'company.required' => 'Company is required',
    					];
    		$validator = Validator::make($request->all(),['fname'=> 'required',
    													  'lname'=>'required',
    													  'email'=>'required|unique:customers,email,'.$id,
    													  'company'=>'required',
    													 ],$message);
    		if($validator->fails()){
    			 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    		}
            $query = Customer::find($id);
            $customerid = $query->customerid; 
            $customercode = $query->customercode;
            $crawl = new CustomerHelper();
            $res = $crawl->update($request,$customercode);

            if($res['Successful']){
                $customer = Customer::whereId($id)->update(['fname' => $request['fname'],
                                                        'lname'=>$request['lname'],
                                                        'email'=>$request['email'],
                                                        'status' => $request['status']]);
                if($customer){
                     
                    $customer_contact = new CustomerContactHelper();
                    $contact = $customer_contact->update($request,$customerid);
                    $customer_company = new CustomerCompanyHelper();
                    $company = $customer_company->update($request,$customerid);
                    $log = new LogsHelper();
                    $log->store('update','Update'.$request['fname'].' '.$request['lname']);
                    return $contact == '1' && $company == '1' ? response()->json(['success'=>true,'message'=>'Customer Updated']) : response()->json(['fail'=>true,'message'=>'An error occured. Unable to create customer.']);  
                }
            }
    		
    		return response()->json(['fail'=>true,'message'=>'An error occured. Unable to update customer.']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }
    public function destroy($id){
    	try{
            $customer = Customer::find($id);
            $customercode = $customer->customercode;
            $crawl = new CustomerHelper();
            $res = $crawl->delete($customercode);
            if($res['Successful']){
               $customer = Customer::whereId($id)->update(['deleted_at'=>Carbon::now('Asia/Manila'),'status' => 2]);
               $log = new LogsHelper();
                    $log->store('Deleted','Delete'.$customercode);
               return response()->json(['success'=>true,'message'=>'Customer Deleted']); 
            }
    		
    		
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }
    public function apiCustomer(){
    	try{
    		if(Auth::user()->status == 1){ //admin sounds payment
		
                $customer = Customer::whereDeleted_at(Null)
                ->select('id','customerid','fname','lname','email','status','customercode')->get();
				return DataTables::of($customer)->make(true);  	
    		}else{
    			$id = Auth::id();
    			$customers = DB::table('customers')
    			->join('customer_contacts','customer_contacts.customerid','=','customers.customerid')
    			->leftjoin('customer_companies','customer_companies.customerid','=','customers.customerid')
    			->where('customers.merchantid', $id)
    			->where('customers.deleted_at','=',Null)->get();
    			return DataTables::of($customer)->make(true);
    		}
				
    	}catch(\Exception $e){
    		return response()->json(['fail' => true,'message'=>$e->getMessage()]);
    	}
    }


    public function showMerchants(){
    	$merchant = Merchant::whereDeleted_at(Null)->get();
    	return $merchant;
    }

    public function showInfo($id){
        $customer = Customer::whereCustomerid($id)
        ->select('id','customercode','customerid','fname','lname','email','status')->first();
        $contact = CustomerContact::whereCustomerid($id)->first();
        $company = CustomerCompany::whereCustomerid($id)->first();
        return response()->json(['customer'=>$customer,'contact'=>$contact,'company'=>$company]);
    }
    
    
}
