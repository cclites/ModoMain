<?php

class Ledger extends Controller{
	
	function updateTestLedger(Request $request)
	{
	    $cost = ($limit*$last);		//total cost of the order in usd
		//$costBtc = ($cost/$last);	//total cost of order in btc
		$usd = 0;
		$btc = 0;
		$currentUsd = $bot->getLedger()->getUsd();
		$currentBtc = $bot->getLedger()->getBtc();
		
		/*
		writeLog("%%% CURRENT usd is $currentUsd");
		writeLog("%%% CURRENT btc is $currentBtc");
		writeLog("%%% Cost is $cost");
		writeLog("%%% Fee in USD is $feeUsd");
		writeLog("%%% Fee in BTC is $feeBtc");
		writeLog("%%% last is $last");					//last price
		writeLog("%%% Limit is $limit");				//order size
		writeLog("%%% Type is $type");
		
		writeLog("**********  Update test ledger.");
		*/
		
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
				
		    $id = $request->id;
		    $owner_id = $request->owner_id;	
			
			//decode those
			$id = Crypt::decrypt($this->id);
			
			DB::table('test_ledger')
                ->where('owner_id', $id)
                ->update(array(
                        'btc' => 5,
                        'usd' => 500

			));
			
		}
		
		//need to make sure this is a valid request first
	
		//dCrypt($session, $token, $_SESSION["id"], $decrypttext);
		//if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])
		//if($token == $decrypttext["token"])
		//{
		    //$query = "UPDATE test_ledger SET btc=$btc, usd= $usd WHERE owner_id=$id";
		    
		    
				
			 
	        //db_updateTestLedger($usd, $btc, $id);
			resetBotHistory($token, $session, $id);
			db_updateLedger($usd, $btc, $id);
			
			//also have to update the bot balances.
			
			sleep(1);		//slight pause to give everything time to update before
			                //sending the response to the client.
		//}
	}
}

?>