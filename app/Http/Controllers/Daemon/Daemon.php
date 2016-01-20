<?php

namespace App\Http\Controllers\Daemon;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticker;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;


class Daemon extends Controller{
	
	
	function main(){
		
		$this->updatetTicker(1);
	}
	
	function updatetTicker($id){
		
		if($id == 1)  //Bitstamp
		{
			$url = config('core.BITSTAMP_GET_TICKER');
		}
		
		//Need to set the trend.
		
		$result = $this->_get($url);
		$result = (array)app('App\Http\Controllers\Ticker')->setTicker($result);

	}
	
	function _get($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode( curl_exec($ch) );
		curl_close($ch);
		
		return $result;
	 
	}
}
