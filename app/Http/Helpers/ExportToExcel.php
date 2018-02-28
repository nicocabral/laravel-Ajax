<?php 
namespace App\Http\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Customer;
use App\CustomerContact;
use App\CustomerCompany;
use DB;
use Alert;
class ExportToExcel{
		public function exportFile(){
				
				 $query = DB::table('customers')
				 ->select('customers.customerid as Customer ID','customers.merchant as Merchant','customers.fname as Firstname','customers.lname as Lastname','customers.email as Email','customers.status as Status','customer_contacts.d_phone as DaytimePhone','customer_contacts.e_phone as EveningPhone','customer_contacts.m_phone as MobilePhone','customer_contacts.customerid','customer_companies.customerid','customer_contacts.fax as Fax','customer_companies.name as Companyname','customer_companies.title as Title','customer_companies.department as Department','customer_companies.created_at')
				 ->join('customer_contacts','customer_contacts.customerid','=','customers.customerid')
				 ->join('customer_companies','customer_companies.customerid', '=', 'customers.customerid')
				 ->where('customers.deleted_at', '=', NULL)
				 ->get();
					$data = json_decode( json_encode($query), true);

				   Excel::create('customers', function($excel) use($data) {
						
				          $excel->sheet('ExportFile', function($sheet) use($data) {
				              $sheet->fromArray($data);
				          });
				      	})->export('xls');

			
			
		}
}