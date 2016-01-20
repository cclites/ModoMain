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
		
		//LOG::error("Type of record is " . gettype($record));
		//LOG::error("Record:" . $record[0]);
		
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
		
		//LOG::info("CurrentMarket " . gettype($currentMarket));
		//LOG::info("PreviousMarket " . gettype($previousMarket));
		

		if($currentMarket->last < $previousMarket->last){
			$currentMarket->direction = -1;
		}else if($currentMarket->last > $previousMarket->last){
			$currentMarket->direction = 1;
		}else{
			$currentMarket->direction = 0;
		}
		
       /*
		if($currentMarket->getLast() < $previousMarket->getLast())   			// trending down
		{
			writeLog("**********  Trending down. ");
			if( $previousMarket->getDirection() == -1)  // was already decreasing
			{
				$t = $previousMarket->getTrend();
				$currentMarket->setTrend( ($t += 1) );
				$currentMarket->setDirection(1);
			}
			else				//was increasing. Set to direction to decreasing,  and reset trend
			{
				writeLog("**********  Was increasing");
				$currentMarket->setTrend(1);
				$currentMarket->setDirection(-1);
			}
		}
		else if ( $currentMarket->getLast() > $previousMarket->getLast() )   // trending up
		{
			writeLog("**********  Trending up");
			if( $previousMarket->getDirection() == 1)		// Was already increasing
			{
				$t = $currentMarket->getTrend();
				$currentMarket->setTrend( ($t += 1) );
				$currentMarket->setDirection(-1);
			}
			else			// was decreasing. Set direction to increasing
			{
				writeLog("**********  Was decreasing");
				$currentMarket->setTrend(1);
				$currentMarket->setDirection(1);
			}
		}
	    * 
	    */
		
		return $currentMarket;
			
		//}
	}
	
	
} 