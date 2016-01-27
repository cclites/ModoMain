<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class Ledger extends Controller{
	
	function updateTestLedger(Request $request)
	{
	    $cost = ($limit*$last);		//total cost of the order in usd
		//$costBtc = ($cost/$last);	//total cost of order in btc
		$usd = 0;
		$btc = 0;
		$currentUsd = $bot->getLedger()->getUsd();
		$currentBtc = $bot->getLedger()->getBtc();
		
		
		//increase BTC, decrease USD													
	    if($type == "p")	//purchase, so subtract fee in BTC;
		{
		    $btc = ($currentBtc + ($limit - $feeBtc));
		    $usd = ($currentUsd - $cost);
		}
		//decrease btc, increase USD
		else if($type == "s") //sale. Subtract fee is USD
		{
		    $btc = ($currentBtc - $limit);
		    $usd = ($currentUsd + ($cost - $feeUsd));
		}
		
		writeLog("Updated usd is $usd");
		writeLog("Updated btc is $btc");
		
		db_updateTestLedger($usd, $btc, $bot->getId());
		writeLog("test ledger updated");
		db_updateLedger($usd, $btc, $bot->getId());
		writeLog("Ledger updated");
		updateBase($last, $bot->getId());
		
		writeLog("********************Completed upating everything");
	}
	
	// Done
	function updateBase($last, $id)
	{
		db_updateBase($last, $id);
	}
	
	function resetTestBalance(Request $request)
	{
		//TODO: Put hard coded values in a config somewhere
	    $usd = 500;
		$btc = 5;
		
		if( Session::get('session') == $request -> session &&
		    Session::get('token') == $request -> token &&
			Session::get('authenticated') ){
				

			$id = Crypt::decrypt($request->owner_id);
			
			LOG::info("ID is " . $id);
			
			//reset the test ledger
			$result = DB::table('test_ledger')
			                ->where('owner_id', $id)
			                ->update(array(
			                        'btc' => 5,
			                        'usd' => 500
			
						));
						
			return json_encode( array("status"=>$result) );
			
		}

	}
}

?>