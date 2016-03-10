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
		$emails =DB::table('member')->pluck('email');
		$ids = DB::table('member')->pluck('id');
		return json_encode(array("email"=>$emails,"id"=>$ids));
	}
}

?>
	