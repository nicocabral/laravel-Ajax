<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Helpers\ExportToExcel;

Route::get('/', function () {
    	if(Auth::check()){
    		return view('dashboard.index');
    	}
    	return view('auth.login');
})->name('login');

//only Authenticated users can enter
Route::group(['middleware'=> ['auth','revalidate']], function(){
	Route::get('/roles', 'api\RoleController@index');
	Route::get('/merchants', 'api\MerchantController@index');
	Route::get('/myprofile', 'api\MyProfileController@index');
	Route::get('/customers', 'api\CustomerController@index');
	Route::get('/contracts', 'api\ContractController@index');
	Route::get('/users', 'api\MerchantUserController@index');
	Route::get('/settings', 'api\SettingController@index');
	Route::get('/billing_reports','api\BillingReportController@index');
	Route::get('/contract_expiration', 'api\ContractExpirationController@index');
	Route::get('/card_expiration', 'api\CardExpirationController@index');
	Route::get('/transaction_reports','api\TransactionReportController@index');



	Route::get('/customer/export', function(){
                     $export = new ExportToExcel();
                     $export->exportFile();
              });

});


//forgot password
Route::post('/forgotpassword/checkemail', 'Auth\ForgotPasswordController@verifyEmail');
//reset password
Route::post('/forgot_password/verify_answer','Auth\ForgotPasswordController@resetPassword');