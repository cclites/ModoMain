<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Illuminate\Support\Facades\Session;
use Crypt;

class Messages extends Controller{
	
	private $id;
	private $owner_id;
	private $session;
	
	function getMessages(Request $request){
		
		$this->id = $request->id;
		$this->owner_id = $request->owner_id;
		$this->session = $request->session;
		$this->token = $request->token;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){
				
				$this->id = Crypt::decrypt($this->owner_id);
			    $messages = DB::table('message')->where('owner_id', $this->id)->pluck('message');
				$types = DB::table('message')->where('owner_id', $this->id)->pluck('type');
			    DB::table('message')->where('owner_id', $this->id)->delete();
		        return json_encode( array('type'=>$types , 'message'=> $messages) );
		}
		
	}
	
} 