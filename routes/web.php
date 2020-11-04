<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('manager')->middleware('auth','can:act-user')->group(function () {
    Route::get('/user','HomeController@dashboard');
    Route::post('/user/store', 'HomeController@store');
	Route::post('/user/edit', 'HomeController@update');
	Route::post('/user/delete', 'HomeController@delete');
	Route::get('/user/search', 'HomeController@search');
	Route::get('/user/searchTable', 'HomeController@searchTable');

	Route::get('/role','RoleController@index');
	Route::post('/role/store', 'RoleController@store');

	Route::get('/departments','DepartmentController@index');
	Route::post('/departments/store', 'DepartmentController@store');
	Route::post('/departments/update', 'DepartmentController@update');
	Route::post('/departments/delete', 'DepartmentController@destroy');
});
Route::prefix('admin')->middleware('auth','can:act-administration')->group(function () {
    Route::get('/user','HomeController@dashboard');
    Route::get('/user/search', 'HomeController@search');
	Route::get('/user/searchTable', 'HomeController@searchTable');

	Route::get('/role','RoleController@index');

	Route::get('/departments','DepartmentController@index');

    Route::get('/services','ServicesController@index');
	Route::post('/services/store', 'ServicesController@store');
	Route::post('/services/update', 'ServicesController@update');
	Route::post('/services/delete', 'ServicesController@destroy');

	Route::get('/serviceBills','BillDetailController@index');
	Route::post('/serviceBills/store', 'BillDetailController@store');
	Route::post('/serviceBills/update', 'BillDetailController@update');
	Route::post('/serviceBills/delete', 'BillDetailController@destroy');

	Route::get('/rooms','RoomController@index');
	Route::post('/rooms/store', 'RoomController@store');
	Route::post('/rooms/update', 'RoomController@update');
	Route::post('/rooms/delete', 'RoomController@destroy');
	Route::get('/rooms/search', 'RoomController@search');
	Route::get('/rooms/searchTable', 'RoomController@searchTable');

	Route::get('/rooms/bills','BillController@index');
	Route::post('/rooms/bills/store', 'BillController@store');
	Route::get('/rooms/bills/edit/{id}', 'BillController@edit');
	Route::post('/rooms/bills/update', 'BillController@update');
	Route::post('/rooms/bills/delete', 'BillController@destroy');

	Route::get('/kindOfRoom', 'KindOfRoomController@index');
	Route::post('/kindOfRoom/store', 'KindOfRoomController@store');
	Route::post('/kindOfRoom/update', 'KindOfRoomController@update');
	Route::post('/kindOfRoom/delete', 'KindOfRoomController@destroy');
	
	Route::get('/customer', 'CustomersController@index');
	Route::post('/customer/store', 'CustomersController@store');
	Route::post('/customer/update', 'CustomersController@update');
	Route::post('/customer/delete', 'CustomersController@destroy');
});

Route::prefix('receptionist')->middleware('auth','can:act-receptionist')->group(function () {
    Route::get('/user','HomeController@dashboard');
    Route::get('/user/search', 'HomeController@search');
	Route::get('/user/searchTable', 'HomeController@searchTable');

	Route::get('/role','RoleController@index');

	Route::get('/departments','DepartmentController@index');

    Route::get('/services','ServicesController@index');

	Route::get('/rooms','RoomController@index');
	Route::post('/rooms/update', 'RoomController@update');
	Route::get('/rooms/search', 'RoomController@search');
	Route::get('/rooms/searchTable', 'RoomController@searchTable');

	Route::get('/kindOfRoom', 'KindOfRoomController@index');
	
	Route::get('/customer', 'CustomersController@index');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
