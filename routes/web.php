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

Route::get('/customer', 'CustomerController@showCustomer');

Route::get('/customer/{id}', 'CustomerController@oneId');

Route::get('/customer/{id}/address', 'CustomerController@showIdAndAddress');

route::get('/customers/by-company/{company_id}', 'CustomersController@customersByCompany_id');