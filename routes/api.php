<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=> ['api','cors','revalidate']], function(){

		//login api
		Route::post('/auth/login','Auth\AuthController@postLogin');
		Route::post('/auth/refresh', 'Auth\TokenController@refresh');
		Route::post('/auth/invalidate', 'Auth\TokenController@invalidate');

	Route::group(['middleware' => 'jwt.auth'], function () {
		//role api
              Route::get('/roles', 'api\RoleController@apiRoles'); 
              Route::resource('/role','api\RoleController');
              Route::get('/roles/list','api\RoleController@showRoles');

              //view permission
              Route::get('/viewpermission/{id}', 'api\PermissionController@show');
              Route::get('/permission/list', 'api\PermissionController@showPermissions');
              Route::get('/role/permission/list/{id}', 'api\PermissionController@showRolesPermissions');

              //Merchants api

              Route::get('/merchants', 'api\MerchantController@apiMerchant');
              Route::resource('/merchant', 'api\MerchantController');

              //reset mechant password

              Route::post('/reset_merchant_password','api\MerchantController@resetPassword');

              //myprofile
              Route::post('/update_myprofile', 'api\MyProfileController@update');
              Route::post('/update_password', 'api\MyProfileController@updatePassword');
              //logout 

              Route::get('/logout', 'Auth\TokenController@invalidate');


              //security question
              Route::get('/security_question', 'api\SecurityQuestionController@show');
              Route::post('/store_security_question', 'api\SecurityQuestionController@store');
              Route::patch('/update_security_question/{id}', 'api\SecurityQuestionController@update');

              //customers
              Route::get('/customers', 'api\CustomerController@apiCustomer');
              Route::resource('/customer', 'api\CustomerController');

              //loadMerchant
              Route::get('/loadmerchants','api\CustomerController@showMerchants');

              //users api
              Route::get('/users', 'api\MerchantUserController@apiUsers');
              Route::resource('/user','api\MerchantUserController');
              Route::post('/user/resetpassword', 'api\MerchantUserController@resetPassword');

              //customer info
              Route::get('/customerinfo/{id}','api\CustomerController@showInfo');

              //settings

              Route::post('/setting', 'api\SettingController@store');
              Route::get('/setting/loadSelectedCodes','api\SettingController@show');


    


              
    });

});

