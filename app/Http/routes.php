<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth', 'approved']], function () {
	Route::get('/inventory', 'ItemController@index');
	Route::post('/inventory', 'ItemController@selectCat');
	Route::post('/inventory/addStock/{item}', 'ItemController@addStock');
	Route::post('/inventory/takeStock/{item}', 'ItemController@takeStock');

	Route::post('/inventory/{item}/buy', 'ItemController@storeOC');
	Route::post('/inventory/{item}/take', 'ItemController@storeOV');

	Route::get('/inventory/addItem', 'ItemController@formAddItem');
	Route::post('/inventory/addItem', 'ItemController@storeItem');

});


Route::get('/admin', ['middleware' => ['auth', 'admin'], 'uses' => 'UserController@getUsers']);
Route::post('/admin/{user}', ['middleware' => ['auth', 'admin'], 'uses' => 'UserController@approveUser']);

Route::get('/admin/oc', ['middleware' => ['auth', 'admin'], 'uses' => 'ItemController@getOC']);
Route::post('/admin/oc/{oc}', ['middleware' => ['auth', 'admin'], 'uses' => 'ItemController@approveOC']);
