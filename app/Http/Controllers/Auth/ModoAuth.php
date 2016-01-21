<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AuthenticateHandler; 

class ModoAuth extends Controller{
	
	
	function validateLogin(Request $request){
		
		$ah = new AuthenticateHandler();
		return $ah->authenticate($request);

	}
	
	function updateLogin(Request $request){
		
		$ah = new AuthenticateHandler();
		return $ah->updateLogin($request);
		
	}
	
	function updateEmail(Request $request){
		
		$ah = new AuthenticateHandler($request);
		return $ah->updateEmail();
		
	}
	
	function updateBsConfigs(Request $request){
		
		$ah = new AuthenticateHandler();
		return $ah->updateBsConfigs($request);
		
	}
	
	function activateAccount(Request $request){
		
		$ah = new AuthenticateHandler();
		return $ah->updateBsConfigs($request);
		
	}
	

}
