<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Illuminate\Support\Facades\Session;

class Ticker extends Controller{
	
	private $id;
	
	function getTicker(Request $request){
		
		$this->id = $request->id;
		$ticker = DB::table('ticker')->where('exchange_id', $this->id)->get();
		return json_encode( array('ticker'=> $ticker) );
		
	}
	
	//gets ticker by exchange id
	function getNewTickerById($currency, $exchangeId){
		
		$record = DB::table('ticker')->where('currency', $currency)->where('exchange_id', $exchangeId)->get();
		return $record[0];
	}
	
	function getTickerById($id){
		
		$record = DB::table('ticker')->where('id', $id)->get();
		return $record[0];
	}
	
	function setTicker($newTicker){
		
		return;
		
		$id = 1;
		$oldTicker = $this->getTickerById($id);
		
		$newTicker = $this->updateTrend($newTicker, $oldTicker);
		
		//$s = print_r($newTicker, true);
		//LOG::error("NEW TICKER " . $s);
		
		$response = DB::table('ticker')
            ->where('id', $id)
            ->update(array(
                        'high'=>$newTicker->high,
                        'last'=>$newTicker->last,
                        'bid'=>$newTicker->bid,
                        'volume'=>$newTicker->volume,
                        'low'=>$newTicker->low,
                        'ask'=>$newTicker->ask,
                        'previous'=>$oldTicker->last,
                        'direction'=>$newTicker->direction
					));
					
		//LOG::error($response);
					
		return json_encode(array('status'=>$response));
		
	}
	
	//The ticker function needs an exchange id and currency type.
	
	function setNewTicker($newTicker, $currency, $exchangeId){
		
		//Log
		Log::info("**********************");
		Log::info(json_encode($newTicker));
		Log::info($currency);
		Log::info($exchangeId);
		Log::info("***********************");
		
		
		
		
		$oldTicker = $this->getNewTickerById($currency, $exchangeId);
		$newTicker = $this->updateTrend($newTicker, $oldTicker);
		
		//$s = print_r($newTicker, true);
		//LOG::error("NEW TICKER " . $s);
		
		$response = DB::table('ticker')
            ->where('exchange_id', $exchangeId)
			->where('currency', $currency)
            ->update(array(
                        'high'=>$newTicker->high,
                        'last'=>$newTicker->last,
                        'bid'=>$newTicker->bid,
                        'volume'=>$newTicker->volume,
                        'low'=>$newTicker->low,
                        'ask'=>$newTicker->ask,
                        'previous'=>$oldTicker->last,
                        'direction'=>$newTicker->direction
					));
					
		//LOG::error($response);
		
		//This needs an error check on the response in order to properly
		//return a pass/fail flag.
					
		return json_encode(array('status'=>$response));
		 
	}
	
	/********************************************************************
	*  updateTrend	- update the market trend and direction
	*
	*  Parameters:
	*  $last				- float representing latest market close in USD
	*  $lastClose		- float representing previous market close in USD
	*
	*  Returns:
	*  $direction		- representing market direction as an int.
	*  $trend				- representing trend as an int.
	*********************************************************************/
	function updateTrend($currentMarket, $previousMarket)
	{
		if($currentMarket->last < $previousMarket->last){
			$currentMarket->direction = -1;
		}else if($currentMarket->last > $previousMarket->last){
			$currentMarket->direction = 1;
		}else{
			$currentMarket->direction = 0;
		}
		
		if($currentMarket->direction < $previousMarket->direction){
			$currentMarket->trend = $previousMarket->trend--;
		}else if($currentMarket->direction > $previousMarket->direction){
			$currentMarket->trend = $previousMarket->trend++;
		}else{
			//do nothing, but hold this place for logging
		}
				
		return $currentMarket;		
	}
} 