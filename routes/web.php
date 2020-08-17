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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/SalesforceToCRM/{session_id}', function () {
//     return view('/SalesforceToCRM/index');
// });

// Route::get('/ViewSalesforceToCRM/{param}', function () {
//     return view('/SalesforceToCRM/showsalesforce');
// });
Route::get('/SalesforceToCRM/{session_id}', 'SalesforceController@MainDetail');
Route::post('/SearchSalesforce', 'SalesforceController@SearchSalesforce');
Route::post('/SearchSalesforce2', 'SalesforceController@SearchSalesforce2');
Route::post('/SearchICSCrm', 'SalesforceController@SearchICSCrm');
Route::get('/ViewSalesforceCreateToCRM/{param}', 'SalesforceController@ViewSalesforceCreateToCRM');
Route::get('/ViewSalesforceUpdateToCRM/{param}', 'SalesforceController@ViewSalesforceUpdateToCRM');
Route::get('/ViewSalesforceMergeToCRM/{param}', 'SalesforceController@ViewSalesforceMergeToCRM');
Route::post('/CreateSfToCrm', 'SalesforceController@CreateCrm');
Route::post('/MergeSfToCrm', 'SalesforceController@MergeCrm');
Route::post('/UpdateSfToCrm', 'SalesforceController@UpdateSfToCrm');
Route::get('/testdata', 'TestController@TestShow');
Route::get('/ViewSalesforceCreateLocationToCRM/{param}', 'SalesforceController@ViewSalesforceCreateLocationToCRM');
Route::post('/CreateSfLocationToCrm', 'SalesforceController@CreateSfLocationToCrm');
Route::get('/ViewSalesforceUpdateLocationToCRM/{param}', 'SalesforceController@ViewSalesforceUpdateLocationToCRM');
Route::post('/UpdateSfLocationToCrm', 'SalesforceController@UpdateSfLocationToCrm');
