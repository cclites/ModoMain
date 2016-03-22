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
	
	public function sendMessages(Request $request){
		$message = $request->message;
		$type = $request->type;
		for($i=0;$i<count($request->id);$i++){
			$id = $request->id[$i];
			DB::table('message')->insert(['owner_id'=>$id , 'message'=>$message, 'type'=>$type]);
		}
		return json_encode( array('status'=> 1, 'message'=>'Messages were sent') );
	}
}

?>
	