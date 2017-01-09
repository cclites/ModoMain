<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticker;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Illuminate\Support\Facades\Session;
use Crypt;

class History extends Controller{
	
	private $id;
	private $owner_id;
	private $ticker;
	private $session;
	
	function getHistory(Request $request){
		
		$this->id = $request->id;
		$this->owner_id = $request->owner_id;
		$this->session = $request->session;
		$this->token = $request->token;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){
				
				$this->id = Crypt::decrypt($this->owner_id);
			    $history = DB::table('historic')->where('owner_id', $this->id)->get();
				
		        return json_encode( array('history'=> $history) );
		}
		
	}
	
	function getHistoryById($owner_id){
		
		$result = DB::table('historic')->where( 'owner_id', $owner_id )->get();
		return $result;
	}
	
	function checkUpdateHistory($bot, $last){

		$tempBot = DB::table("bot")->where("id", $bot->id)->get();

		$history = $this->getHistoryById( $bot->owner_id );

		$currentVal = $tempBot[0]->usd + ($last * $tempBot[0]->btc);
		$doUpdate = false;
		$nLow = 0;
		$nHigh = 0;
		$date = date("y/m/d");
		
		
		$historicalData = array(
				    'high'=> $history[0]->high,
				    'low'=> $history[0]->low,
				    'date_low'=>$history[0]->date_low,
				    'date_high'=>$history[0]->date_high,
				    'start_usd'=>$history[0]->start_usd,
				    'start_btc'=>$history[0]->start_btc,
				    'owner_id'=>$bot->owner_id,
				    'currency'=>"BTC"
				);
				
		if( $currentVal < $history[0]->low ){
			
			$historicalData["date_low"] = $date;
			$historicalData["low"] = $currentVal;
			$doUpdate = true;
			
		}else if($currentVal > $history[0]->high){
			
			$historicalData["date_high"] = $date;
			$historicalData["high"] = $currentVal;
			$doUpdate = true;
		}
		
		if( $doUpdate ){
			
			$this->updateHistorical($historicalData, $bot->owner_id);
		}
				
	}
	
	function resetBotHistory(Request $request)	//need the bot id to reset
	{

		if( Session::get('session') == $request->session &&
		    Session::get('token') == $request->token &&
			Session::get('authenticated') ){
				
				
				$ticker = $this->getPrevTicker();		
				$this->id = Crypt::decrypt($request->id);
				$this->owner_id = Crypt::decrypt($request->owner_id);				
				$bot = $this->getBotById($this->id);		
				$usd = $bot[0]->btc * $ticker->previous + $bot[0]->usd;
				$date = date("y/m/d");
				$high = str_replace(",", "", number_format($usd,2));
				$low = str_replace(",", "", number_format($usd,2));
				
				$historicalData = array(
				    'high'=> $high,
				    'low'=> $low,
				    'date_low'=>$date,
				    'date_high'=>$date,
				    'start_usd'=>$bot[0]->usd,
				    'start_btc'=>$bot[0]->btc,
				    'owner_id'=>$this->id,
				    'currency'=>"BTC"
				);
				//LOG::info($historicalData);
				return $this->updateHistorical($historicalData, $this->owner_id);
				
			}	
	}

	function updateHistorical($historicalData, $id)
	{
		
		LOG::info("Updating historical");
		LOG::info("ID is $id");
		
		$response = DB::table('historic')
            ->where('owner_id', $id)
            ->update(array(
                        'high' => $historicalData["high"],
                        'low' => $historicalData["low"],
                        'date_low' => $historicalData["date_low"],
                        'date_high' => $historicalData["date_high"],
                        'start_usd' => $historicalData["start_usd"],
                        'start_btc' => $historicalData["start_btc"]
					));
			
	        return json_encode( array('status'=>1, 'message'=>'History reset') );

	}
	
	//for internal use
	function getPrevTicker(){
		
		$ticker = DB::table('ticker')->where('exchange_id', 1)->get();
		return $ticker[0];
	}
	
	function getBotById($id){
		
		$bot = DB::table('bot')->where('id', $id)->get();
		return $bot;
	}
	

} 