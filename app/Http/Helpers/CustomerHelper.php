<?php 
namespace App\Http\Helpers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CustomerHelper
{
	public function store($request)
	{
		try
		{
			
			
			 $client = new Client(); //GuzzleHttp\Client
			 $result = $client->post('https://dev-api-payment.igentechnologies.com/api/customers',[
			 		'form_params' => [
                        'AddCustomer'=>[
                            "externalCustRefNumber" => $request['customerid'],
                                'personalDetails'=>[
                                    "firstName" => $request['fname'],
                                    "lastName" => $request['lname'],
                                    "middleName" => "",
                                    "dateOfBirth" => $request['dob'],
                                    "addressLine1" => "PersonalAddress1",
                                    "zip" => "12345",
                                    "state" => "AB",
                                    "country" => "AGO"
                                ],
                                'companyDetails' =>[
                                    "companyName"=> $request['company'],
                                    "taxID"=> "NOTAX",
                                    "businessType" => "ABC",
                                    "addressLine1"=> "OfficeAddress21",
                                    "zip"=> "54321",
                                    "state"=> "BC",
                                    "country"=> "ALA"
                                ],
                                "walletDetails" => []

                            ]
                        ]

			 ]);
			$r = json_decode($result->getBody()->getContents(),true);
			return $r;

		}catch(\Exception $e)
		{
			return $e;
		}
	}

    public function update($request, $customer_code){
        try{
        	$stat = "";
        	if($request['status'] == 1)
        		$stat = 'Active';
        	else 
        		$stat = 'Inactive';

             $client = new Client(); //GuzzleHttp\Client
             $result = $client->put('https://dev-api-payment.igentechnologies.com/api/customers',[


                    'form_params' => [
                        'UpdateCustomer'=>[
                            "customerCode" => $customer_code,
                                'personalDetails'=>[
                                    "firstName" => $request['fname'],
                                    "lastName" => $request['lname'],
                                    "middleName" => "",
                                    "dateOfBirth" => $request['dob'],
                                    "addressLine1" => "PersonalAddress1",
                                    "zip" => "12345",
                                    "state" => "AB",
                                    "country" => "AGO"
                                ],
                                'companyDetails' =>[
                                    "companyName"=> $request['company'],
                                    "taxID"=> "NOTAX",
                                    "businessType" => "ABC",
                                    "addressLine1"=> "OfficeAddress21",
                                    "zip"=> "54321",
                                    "state"=> "BC",
                                    "country"=> "ALA"
                                ],
                                "walletDetails" => [],
                                "customerStatus"=> strtoupper($stat),

                            ]
                        ]

             ]);
                $r = json_decode($result->getBody()->getContents(),true);
                return $r;

        }catch(\Exception $e){
            return $e;
        }
    }

    public function delete($customer_code){
        try{
            $client = new Client(); //GuzzleHttp\Client
             $result = $client->put('https://dev-api-payment.igentechnologies.com/api/customers',[


                    'form_params' => [
                        'UpdateCustomer'=>[
                            "customerCode" => $customer_code,
                                'personalDetails'=>[
                                    "firstName" =>"Deleted",
                                    "lastName" =>"Deleted",
                                    "middleName" => "",
                                    "dateOfBirth" => "2018-02-05",
                                    "addressLine1" => "PersonalAddress1",
                                    "zip" => "12345",
                                    "state" => "AB",
                                    "country" => "AGO"
                                ],
                                'companyDetails' =>[
                                    "companyName"=> "XYZ",
                                    "taxID"=> "NOTAX",
                                    "businessType" => "ABC",
                                    "addressLine1"=> "OfficeAddress21",
                                    "zip"=> "54321",
                                    "state"=> "BC",
                                    "country"=> "ALA"
                                ],
                                "walletDetails" => [],
                                "customerStatus" => "DELETE",

                            ]
                        ]

             ]);
            $r = json_decode($result->getBody()->getContents(),true);
            return $r;

        }catch(\Exception $e){
            return $e;
        }
    }
}