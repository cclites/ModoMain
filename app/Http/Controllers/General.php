<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class General extends Controller{
	
	public function submitContact(Request $request){
		
		$this->mail($request, 'submitContact');
        return json_encode(array( 'status'=>1, 'message'=>'Contact Submitted') );		
	}
	
	/*
	 * $mailObject contains visitor email, subject, message, recipient email
	 */
	public function mail($mailObject, $type){
		//TODO: do something with the email, like actually email it, for instance.
		LOG::info("{Sending an email}");
	}
	
}
