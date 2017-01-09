<?php

/*
 * This bot runs once a minute to grab new pricing information from BitStamp, and to 
 * process each bot to determine if anything needs to be done. BitStamp rate-limits
 * to one request per-minute, per-user. OVer that, and they will put a temp-ban on 
 * the daemon's ip.
 * 
 * This is currently how the daemon is scheduled:
 * wget http://modobot.com/ModoMain/public/daemon
 * 
 * Simply calls the api - it should really be passing a security parameter in the URL
 * to prevent shenanigans, because anyone can hit this api point. For example:
 * wget http://modobot.com/ModoMain/public/daemon?MYSECRETPARAM=123456
 */

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
		
		//This calls an emergency stop file to kill the daemon. This is handy
		//in case the daemon gets away from you.
		$key = file_get_contents("scripts/run.txt");

		if ($key != "1"){
			exit("Daemon was stopped");
		}
		
		//echo("\nBot is running\n");
		LOG::info("Updating the ticker.");
		
		$this->updatetTicker(1);
   
        //hard work starts here
        $bots = app('App\Http\Controllers\Bot')->getAllActiveBots();
		$result = app('App\Http\Controllers\Bot')->processBotRules($bots);
        return $result;
	}
	
	function updatetTicker($id){
		
		
		/****************************************************/
		
		$url = config('core.BITSTAMP_GET_TICKER_USD');
		$result = $this->_get($url);
		$result = (array)app('App\Http\Controllers\Ticker')->setNewTicker($result, "btc", $id);
		
		$url = config('core.BITSTAMP_GET_TICKER_EUR');
		$result = $this->_get($url);
		$result = (array)app('App\Http\Controllers\Ticker')->setNewTicker($result, "eur", $id);
		

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
