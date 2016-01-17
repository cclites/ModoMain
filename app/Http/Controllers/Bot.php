<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class Bot extends Controller{
	
	private $token;
	private $session;
	
	public function getBotState(Request $request){
		
		$this -> token = $request -> token;
		$this -> session = $request -> session;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){  //valid. Get the associated bot.
			
			//Need the owner ID.
			$id = DB::table('member')->where('token', $this->token)->pluck("id");
			
			//get bots by owner ID
			$bot = DB::table('bot')->where('owner_id', $id)->get();
			
			//before I send this back, I want to encode the owner id and id.
			
			$bot[0]->id = Crypt::encrypt($bot[0]->id);
			$bot[0]->owner_id = Crypt::encrypt($bot[0]->owner_id);
			
			return json_encode( array("bot"=>$bot) );
					
		}else{

			return json_encode( array('bot'=> 0) );
		}
		
		
	}
	
}
