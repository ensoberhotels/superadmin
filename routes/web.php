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

// Frontend

Route::get('/', function () {
    return view('welcome');
});

// clear cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    return "<h1 style='text-align: center;'>!!Cache cleared successfully!</h1>";
});

// Get the current database connection info
Route::get('/artisan-database', function() {
	try {
		print_r('databse name= '.DB::connection()->getDatabaseName());
	} catch (\Exception $e) {
		die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

Route::get('testpdf/', 'ItineraryController@downloadSendQuotation');

Route::get('/viewhotel/{id}', 'CommanController@viewHotel');


// Hotel

Route::get('/', 'superAdminController@index');
Route::get('/logout', 'superAdminController@logout');
Route::get('/forget-password', 'superAdminController@forgetPassword');

Route::get('/reset-password/{id}', 'superAdminController@resetPassword');
Route::post('/sendMail', 'superAdminController@sendMail');
Route::post('/login', 'superAdminController@adminLogin');

Route::get('/dashboard', 'superAdminController@dashboard');
Route::get('/company-master', 'CompanyMasterController@index');
Route::get('/company-master/create', 'CompanyMasterController@create');
Route::post('/company-master/save', 'CompanyMasterController@save');
Route::get('/company-master/{id}', 'CompanyMasterController@edit');
Route::post('/company-master/update', 'CompanyMasterController@update');
Route::post('/company-master', 'CompanyMasterController@delete');
Route::get('/module-master', 'ModuleMasterController@index');
Route::get('/module-master/create', 'ModuleMasterController@create');
Route::post('/module-master/save', 'ModuleMasterController@save');
Route::get('/module-master/{id}', 'ModuleMasterController@edit');
Route::post('/module-master/update', 'ModuleMasterController@update');
Route::post('/module-master', 'ModuleMasterController@delete');
Route::get('/menu-master', 'MenuMasterController@index');
Route::get('/menu-master/create', 'MenuMasterController@create');
Route::post('/menu-master/save', 'MenuMasterController@save');
Route::get('/menu-master/{id}', 'MenuMasterController@edit');
Route::post('/menu-master/update', 'MenuMasterController@update');
Route::post('/menu-master', 'MenuMasterController@delete');
Route::get('/company-privilege', 'CompanyPrivilageController@index');
Route::get('/company-privilege/create', 'CompanyPrivilageController@create');
Route::post('/company-privilege/data', 'CompanyPrivilageController@getTableData');
Route::post('/company-privilege/logintyp', 'CompanyPrivilageController@loginTyp');
Route::post('/company-privilege/save', 'CompanyPrivilageController@save');
Route::get('/company-privilege/{id}', 'CompanyPrivilageController@edit');
Route::post('/company-privilege/update', 'CompanyPrivilageController@update');
// clear cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');   
    return "<h1 style='text-align: center;'>Cache cleared successfully !</h1>";
});

// Route::post('/apply-company', 'EnquiryAPIController@save');
// Route::post('/api/apply-company', 'EnquiryAPIController@save');