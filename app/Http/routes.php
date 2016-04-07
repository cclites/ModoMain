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

/*
Route::get('/routetest', function(){
	return view('routetest');
});
 */

Route::get('/ticker', 'Ticker@getTicker');
Route::get('/validateaccount', 'Auth\ModoAuth@validateAccount');
Route::get('/resetaccountpass', 'Auth\ModoAuth@resendAccountPass');
Route::post('/resetpassupdate', 'Auth\ModoAuth@resetPassUpdate');
Route::get('/sweep', 'Sweeper@sweep');
Route::get('/submitcontact', 'General@submitContact');
Route::get('/getEmails', 'AdminView@getEmails');
Route::post('/sendMessageToUsers', 'AdminView@sendMessages');

//Route::get('/addwallets' , 'Wallet@addWallets');

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
	Route::post('/messages', 'Messages@getMessages');
    Route::post('/history', 'History@getHistory');
	Route::post('/update', 'Bot@updateConfigs');
	Route::post('/resetbalance', 'Ledger@resetTestBalance');
	Route::post('/resethistory', 'History@resetBotHistory');
	Route::post('/transactions', 'Transaction@getTransactions');
	Route::post('/updateuserconfigs','SiteOptions@updateConfigs');
	Route::post('/priceNotification','SiteOptions@priceNotification');
	
	Route::post('/updatelogin', 'Auth\ModoAuth@updateLogin');
	Route::post('/updateemail', 'Auth\ModoAuth@updateEmail');
	Route::post('/updatebsconfigs', 'Auth\ModoAuth@updateBsConfigs');
	Route::post('/activateaccount', 'Auth\ModoAuth@activateAccount');
	
	Route::post('/addnewuser', 'Auth\ModoAuth@addNewUser');
	Route::post('/resetpassword', 'Auth\ModoAuth@resetPassword');
	Route::post('/resendvalidation', 'Auth\ModoAuth@resendValidation');
	
	Route::get('/daemon', 'Daemon\Daemon@main');
	
	Route::get('/notifications', 'Daemon\Notifications@main');
	
	
});
