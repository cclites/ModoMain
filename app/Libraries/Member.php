<?php

namespace App\Libraries;

use DB;
use Log;

class Member{
	
	function getMemberInfo($token)
	{
		$users = DB::table('member')->where('token', $token)->get();
		
		if ( count($users) == 0){
			return ""; 
		}else{
			return $users[0];
		}
		
		
		
	}
}
