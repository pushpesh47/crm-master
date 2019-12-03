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
	Route::get('/optimize', function() {
	    $exitCode = Artisan::call('optimize:clear');
	    return 'DONE'; //Return anything
	});
	Route::get('/clear-cache', function() {
	    $exitCode = Artisan::call('config:clear');
	    $exitCode = Artisan::call('cache:clear');
	    $exitCode = Artisan::call('config:cache');
	    return 'DONE'; //Return anything
	});
	Route::get('/migrate', function() {
	    $exitCode = Artisan::call('migrate');
	    return 'DONE'; //Return anything
	});
	Route::get('crm/login','Admin\AdminController@login');
	Route::post('crm/login','Admin\AdminController@authCheck');
	Route::get('crm/logout', function () {
		\Auth::logout();
		\Session::flash('success', 'Logout successful!'); 
	    return redirect('crm/login');
	});

	/*This ROUTE is for CREATE LEADS FRON EXTERNAL SOURCE USING CRON*/
	Route::get('facebook-leads','Admin\LeadsExternal@getLead');
	/*END*/

	Route::group(['namespace' => 'Admin','prefix' => 'crm', 'middleware' => ['adminAuth']] ,function(){

		Route::get('/dashboard','AdminController@dashboard');
		Route::get('/profile','AdminController@profile');
		Route::get('/setting','AdminController@setting');
		Route::get('/change-password','AdminController@changePass');
		Route::post('/updateProfile','AdminController@updateProfile');
		Route::post('/change-password','AdminController@changePassword');


		Route::get('/accounts/mail','AccountController@mail');
		Route::post('/accounts/bulk-delete','AccountController@bulkDelete');
		Route::post('/accounts/mail-sent','AccountController@mailSent');
		Route::post('/accounts/mailer-export','AccountController@mailExport');
		Route::post('/accounts/get-mail-template','AccountController@getMailTemplate');
		Route::post('/accounts/pdf-export','AccountController@AccountExportPDF');
		Route::post('/accounts/pdf','AccountController@export');
		Route::get('/accounts/csv-export','AccountController@csvExport');
		Route::post('accounts/status','AccountController@changeStatus');
		Route::get('accounts/{id}/duplicate','AccountController@duplicate');
		Route::resource('/accounts','AccountController');

		Route::get('/filter','FilterController@createFilter');

		Route::post('form-module/status','FormModuleController@changeStatus');
		Route::resource('/form-module','FormModuleController');

		Route::post('user-role/status','UserRoleController@changeStatus');
		Route::resource('/user-role','UserRoleController');

		Route::post('lead-source/status','AccountStatusController@changeStatus');
		Route::resource('/account-status','AccountStatusController');

		Route::post('lead-source/status','LeadSourceController@changeStatus');
		Route::resource('/lead-source','LeadSourceController');

		Route::post('user/status','UserController@changeStatus');
		Route::resource('/user','UserController');

		Route::post('emails/status','EmailController@changeStatus');
		Route::post('emails/sent','EmailController@SentEmail');
		Route::resource('/emails','EmailController');
	});
 