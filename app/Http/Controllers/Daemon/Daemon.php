<?php

namespace App\Http\Controllers\Daemon;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticker;
use \Bot;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;


class Daemon extends Controller{
	
	
	function main(){
		
		//echo("\nBot is running\n");
		
		$this->updatetTicker(1);
   
        $bots = app('App\Http\Controllers\Bot')->getAllActiveBots();
		$result = app('App\Http\Controllers\Bot')->processBotRules($bots);
        return $result;
	}
	
	function updatetTicker($id){
		
		if($id == 1)  //Bitstamp
		{
			$url = config('core.BITSTAMP_GET_TICKER');
		}
		
		echo "Getting ticker \n";
		
		$result = $this->_get($url);
		
		//echo "Should be a ticker here.....\n";
		//print_r($result);
		
		$result = (array)app('App\Http\Controllers\Ticker')->setTicker($result);

	}
	
	function _get($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode( curl_exec($ch) );
		
		
		if($errno = curl_errno($ch)) {
		    $error_message = curl_strerror($errno);
		    echo "cURL error ({$errno}):\n {$error_message}";
		}
		
		curl_close($ch);
		
		return $result;
	 
	}
}
