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
	
	function getTickerById($id){
		
		$record = DB::table('ticker')->where('id', $id)->get();
		return $record[0];
	}
	
	function setTicker($newTicker){
		
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