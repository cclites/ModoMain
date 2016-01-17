<?php

namespace App\Http\Controllers;
	
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Illuminate\Support\Facades\Session;
use Crypt;

class Balance extends Controller{
	
	private $id;
	private $owner_id;
	private $ticker;
	private $session;
	
	function getBalance(Request $request){
		
		$s = print_r($request, true);
		return ($request->id);
		
		$this->id = $request->id;
		$this->owner_id = $request->owner_id;
		$this->session = $request->session;
		$this->ticker = $request->ticker;
		
		LOG::info($this->id);
		LOG::info($this->owner_id);
		
		//LOG::info(  Crypt::decrypt($this->id) );
		//LOG::info(  Crypt::decrypt($this->owner_id) );
		
		return -999;
		
	}
}
	