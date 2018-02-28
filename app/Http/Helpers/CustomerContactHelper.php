<?php 
namespace App\Http\Helpers;
use App\CustomerContact;
class CustomerContactHelper{
	public function store($request,$customerid){
		$contact = new CustomerContact;
		$contact->d_phone = $request['dphone'];
		$contact->e_phone = $request['ephone'];
		$contact->m_phone = $request['mphone'];
		$contact->fax = $request['fax'];
		$contact->customerid = $customerid;
		$contact->save();
		if($contact){
			$result = [1];
			return implode($result);
		}
	}

	public function update($request,$customerid){
		$contact = CustomerContact::whereCustomerid($customerid)
		->update(['d_phone' => $request['dphone'],
				  'e_phone' => $request['ephone'],
				  'm_phone' => $request['mphone'],
				  'fax' => $request['fax']]);
		if($contact){
			$result = [1];
			return implode($result);
		}
	}
}