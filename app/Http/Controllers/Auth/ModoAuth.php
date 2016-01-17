<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AuthenticateHandler; 

class ModoAuth extends Controller{
	
	
	function validateLogin(Request $request){
		
		$ah = new AuthenticateHandler($request);
		return $ah->authenticate();

	}
	

}
