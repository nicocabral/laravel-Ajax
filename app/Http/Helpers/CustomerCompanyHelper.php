<?php  
namespace App\Http\Helpers;
use App\CustomerCompany;
class CustomerCompanyHelper{
	public function store($request,$customerid){
		$company = new CustomerCompany;
		$company->name = $request['company'];
		$company->title = $request['title'];
		$company->department = $request['dep'];
		$company->customerid = $customerid;
		$company->save();
		if($company){
			$result = [1];
			return implode($result);
		}
	}

	public function update($request,$customerid){
		$company = CustomerCompany::whereCustomerid($customerid)
		->update(['name' => $request['company'],
				  'title' => $request['title'],
				  'department' => $request['dep']]);
		if($company){
			$result = [1];
			return implode($result);
		}
	}
}