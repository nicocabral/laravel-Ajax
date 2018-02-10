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
Route::group(['middleware'=> ['api','cors']], function(){

		//login api
		Route::post('/auth/login','Auth\AuthController@postLogin');
		Route::post('/auth/refresh', 'Auth\TokenController@refresh');
		Route::post('/auth/invalidate', 'Auth\TokenController@invalidate');

	Route::group(['middleware' => 'jwt.auth'], function () {
		//role api
       Route::get('/roles', 'api\RoleController@apiRoles'); 
       Route::resource('/role','api\RoleController');

       //view permission
       Route::get('/viewpermission/{id}', 'api\PermissionController@show');

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
    });
});

