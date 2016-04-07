<?php

namespace App\Http\Controllers\Daemon;

use App\Http\Controllers\Controller;
use App\Libraries\AuthenticateHandler;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;


class Notifications extends Controller{
	
	
	function main(){
		

		LOG::info("Finding Notifications");
		
   		$price = DB::table('ticker')->where('id',1)->pluck('last');
		$ids = DB::table('notifications')->whereBetween('priceNotify',[$price[0]-1, $price[0]+1])->pluck('id');
		$message = "We would like to notify you that the price is currently ".$price[0];
		$ah = new AuthenticateHandler();
		for($i=0;$i<sizeof($ids);$i++){
			$id = DB::table('notifications')->where('id',$ids[$i])->pluck('owner_id');
			$email = DB::table('member')->where('id',$id[0])->pluck('email');
			$ah->sendEmail($email[0], $message);
			DB::table('notifications')->where('id',$ids[$i])->delete();
		}
        return;
	}
	

}