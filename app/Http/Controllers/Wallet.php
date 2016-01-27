<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class Wallet extends Controller{
	
	
	public function addWallets(){
		
		//LOG::info("Found Route");
		//LOG::info( getcwd ( ) );
		
		$files = file_get_contents('../storage/logs/clean.log');
		$lines = explode("\n", $files);
		 
		foreach($lines  as $line ){
			
			LOG::info($line);
			DB::table('wallet')->insert(['address'=>$line]);
		}
		
		return "Complete.";
	}
	
	
	
	
}
