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

class SiteOptions extends Controller{
	
	public function updateConfigs(Request $request){
		$this -> token = $request -> token;
		$this -> session = $request -> session;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){
				
				$id = DB::table('member')->where('token', $this->token)->pluck("id");
				$exists = DB::table('userconfigs')->where('owner_id', $id)->where('name',$request->name)->pluck('id');
				if($exists){
					DB::table('userconfigs')->where('owner_id', $id[0])->where('name',$request->name)->update(['param'=>$request->param]);
				}else{
					$id = DB::table('userconfigs')->insertGetId(['owner_id' => $id[0],'name' => $request->name, 'param'=>$request->param]);
				}

				return json_encode(array("status"=>1,"message"=>"User configs have been updated."));
		}
	}
	
	public function priceNotification(Request $request){
		$this -> token = $request -> token;
		$this -> session = $request -> session;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){
				
				$id = DB::table('member')->where('token', $this->token)->pluck("id");
				$exists = DB::table('notifications')->where('owner_id', $id)->pluck('id');
				if(count($exists)>10){
					return json_encode(array("status"=>0,"message"=>"Limit exceeded for price notifications."));
				}else{
					$id = DB::table('notifications')->insertGetId(['owner_id' => $id[0], 'priceNotify'=>$request->price]);
				}

				return json_encode(array("status"=>1,"message"=>"Notification will be sent when price is reached."));
		}
	}
	
	
}


	