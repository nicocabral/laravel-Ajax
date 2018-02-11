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
use App\CustomerContact;
use App\CustomerCompany;
use App\Merchant;
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Helpers\EmailHelper;


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
    		$customer = new Customer;
    		$customer->customerid = $request['customerid'];
    		$customer->customercode = $request['customerid'];
    		$customer->fname = $request['fname'];
    		$customer->lname = $request['lname'];
    		$customer->email = $request['email'];
    		$customer->merchant = $request['merchant'];
    		$customer->status = $request['status'];
    		$customer->save();
    		if($customer){
    			$customer_contact = new CustomerContact;
    			$customer_contact->customerid = $customer->customerid;
    			$customer_contact->d_phone = $request['dphone'];
    			$customer_contact->e_phone = $request['ephone'];
    			$customer_contact->m_phone = $request['mphone'];
    			$customer_contact->fax = $request['fax'];
    			$customer_contact->save();
    			$customer_company = new CustomerCompany;
    			$customer_company->customerid = $customer->customerid;
    			$customer_company->name = $request['company'];
    			$customer_company->title = $request['title'];
    			$customer_company->department = $request['dep'];
    			$customer_company->save();

    			return response()->json(['success'=>true,'message'=>'Customer created']);
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
    		$customer = Customer::whereId($id)->update(['fname' => $request['fname'],
    													'lname'=>$request['lname'],
    													'email'=>$request['email'],
    													'merchant' => $request['merchant'],
    													'status' => $request['status']]);
    		if($customer){
    			$query = Customer::find($id);
    			$customerid = $query->customerid;
    			$customer_contact = CustomerContact::whereCustomerid($customerid)
    							  ->update(['d_phone' => $request['dphone'],
    										'e_phone' => $request['ephone'],
    										'm_phone' => $request['mphone'],
    										'fax' => $request['fax']]);
    			$customer_company = CustomerCompany::whereCustomerid($customerid)
    								 ->update(['name' => $request['company'],
    								 		   'title' => $request['title'],
    								 		   'department' => $request['dep']]);
    				return response()->json(['success'=>true,'message'=>'Customer updated']);				 
    		}
    		return response()->json(['fail'=>true,'message'=>'An error occured. Unable to create customer.']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }
    public function destroy($id){
    	try{
    		$customer = Customer::whereId($id)->update(['deleted_at'=>Carbon::now('Asia/Manila')]);
    		return response()->json(['success'=>true,'message'=>'Customer Deleted']);
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}
    }
    public function apiCustomer(){
    	try{
    		if(Auth::user()->status == 1){ //admin sounds payment
				$customer = DB::table('customers')
				->select('customers.*','customer_contacts.d_phone','customer_contacts.e_phone','customer_contacts.m_phone','customer_contacts.fax','customer_companies.name','customer_companies.title','customer_companies.department')
				->join('customer_contacts','customer_contacts.customerid','=','customers.customerid') 
				->join('customer_companies','customer_companies.customerid', '=', 'customers.customerid')
				->where('customers.deleted_at','=', Null)->get(); 
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
    
}
