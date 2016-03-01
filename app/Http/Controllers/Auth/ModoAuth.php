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
		$ah = new AuthenticateHandler();
		return $ah->updateEmail($request);	
	}
	
	function updateBsConfigs(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->updateBsConfigs($request);	
	}
	
	function activateAccount(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->activateAccount($request);
	}
	
	function addNewUser(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->addNewUser($request);
	}
	
	function resetPassword(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->resetPassword($request);
	}
	
	function updateResetPassword(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->updateResetPassword($request);
	}
	
	function resendValidation(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->resendValidation($request);
	}
	
	function validateAccount(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->validateAccount($request);
	}
	
	function resendAccountPass(Request $request){
		$ah = new AuthenticateHandler();
		return $ah->resendAccountPass($request);
	}
	

}
