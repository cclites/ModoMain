<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Illuminate\Support\Facades\Session;
use Crypt;

class History extends Controller{
	
	private $id;
	private $owner_id;
	private $ticker;
	private $session;
	
	function getHistory(Request $request){
		
		$this->id = $request->id;
		$this->owner_id = $request->owner_id;
		$this->session = $request->session;
		$this->token = $request->token;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){
				
				$this->id = Crypt::decrypt($this->id);
			    $history = DB::table('historic')->where('owner_id', $this->id)->get();
		        return json_encode( array('history'=> $history) );
		}
		
	}
} 