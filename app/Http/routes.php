<?php

use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //load splash
    return view("main");
});

Route::get('/routetest', function(){
	return view('routetest');
});

Route::get('/ticker', 'Ticker@getTicker');
Route::get('/daemon', 'Daemon\Daemon@main');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	
    Route::post('/account', 'Auth\ModoAuth@validateLogin');
    Route::post('/state', 'Bot@getBotState');
    Route::post('/history', 'History@getHistory');
	Route::post('/update', 'Bot@updateConfigs');
	Route::post('/resetbalance', 'Ledger@resetTestBalance');
	Route::post('/resethistory', 'History@resetBotHistory');
	Route::post('/transactions', 'Transactions@getTransaction');
});
