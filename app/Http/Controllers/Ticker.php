<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Illuminate\Support\Facades\Session;

class Ticker extends Controller{
	
	private $id;
	
	function getTicker(Request $request){
		
		$this->id = $request->id;
		$ticker = DB::table('ticker')->where('exchange_id', $this->id)->get();
		return json_encode( array('ticker'=> $ticker) );
		
	}
} 