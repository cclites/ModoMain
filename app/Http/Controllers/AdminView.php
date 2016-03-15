<?php

namespace App\Http\Controllers;

use App\Libraries\Bitstamp;
use App\Libraries\AuthenticateHandler;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminView;
use Illuminate\Http\Request;
use Log;
use DB;
use Illuminate\Support\Facades\Session;

class AdminView extends Controller{
	public function getEmails(){
		$users =DB::table('member')->select('id', "email","ring")->get();
		//$ids = DB::table('member')->pluck('id');
		return json_encode(array("users"=>$users));
	}
}

?>
	