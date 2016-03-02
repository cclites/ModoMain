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
		
		$cAddress = $request -> cAddress;
		$cMessage = $request -> cMessage;
		$cSubject = $request -> cSubject;
		$to = "chad@extant.digital";  // will need to be a modobot email eventually
		
		$message = "Message from: $cAddress\n" . $cMessage;
		
		 mail ($to , $cSubject ,  $message);
		
		//$this->mail($request, 'submitContact');
        return json_encode(array( 'status'=>1, 'message'=>'Contact Submitted') );		
	}
	
	/*
	 * $mailObject contains visitor email, subject, message, recipient email
	 */
	public function mail($mailObject, $type){
		//TODO: do something with the email, like actually email it, for instance.
		LOG::info("{Sending an email}");
		
		//$recipient = ""
		
		
		
	}
	
}
