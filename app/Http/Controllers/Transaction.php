<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class Transaction extends Controller{
	
	private $bot;
	private $ticker;
	//private $triggers;

    public function updateTransaction($bot, $ticker){
    	
		$this->bot = $bot;
		$this->ticker = $ticker;
		

		//echo "1<br>";
		$this->setTransactionLimits();
		//echo "<pre>";
		//print_r($this->bot);
		
		
		//$this->bot->triggers = $this->setTriggers();
		//echo "2<br>";
		//print_r($this->bot);
		
		
		$this->checkTransactionRules();
		//echo "3<br>";
		//print_r($this->bot);
		
		//return;
    	//return $this->bot;
    }
	
	public function setTransactionLimits(){
		
		$buyLimitBtc = $this->bot->buy_limit_btc;
		$sellLimitBtc = $this->bot->sell_limit_btc;
		$fee = ".005";
		$usd = $this->bot->usd;
		$btc = $this->bot->btc;
		
		
		//purchases
		$this->bot->total_usd_can_purchase = $this->bot->usd - ($this->bot->usd * $fee); 				//this is the most I can purchase.,
		                                                                                 				//so dollar amount can be no higher.
		
		$this->bot->total_btc_can_purchase = $this->bot->total_usd_can_purchase / $this->ticker->last;  //the most BTC I can purchase, based
																										//the max dollar amount I can spend.
																										
		
		$wantToBuyInBtc = ($buyLimitBtc == 0)? $this->bot->btc : $buyLimitBtc;  //Amount of BTC I want to buy

		//the amount of btc I can actually buy.
        $this->bot->total_btc_can_purchase =  ( $this->bot->total_btc_can_purchase < $wantToBuyInBtc) ? $wantToBuyInBtc : $this->bot->total_btc_can_purchase;
				
				
		//Do I have enough money to make that purchase?
		$totes = $this->bot->total_btc_can_purchase * $this->ticker->last;
		
		$usdNeededForPurchase = ($totes) - (  $totes * $fee);
		
		echo "Total usd needed for purchase $usdNeededForPurchase\n";
		echo $this->bot->total_usd_can_purchase . "\n";
		
		//not convinced that this logic is correct.
		$this->bot->total_usd_can_purchase = ( $this->bot->total_usd_can_purchase < $usd )? $usd : $this->bot->total_usd_can_purchase;
		
		if ( $this->bot->total_usd_can_purchase  == 0){
			$this->bot->total_btc_can_purchase = 0;
		}else{
			$this->bot->total_btc_can_purchase = $this->bot->total_usd_can_purchase / $this->ticker->last;
		}
		
		/*********************************/
		
		if($sellLimitBtc == 0){
			$sellLimitBtc = $btc;
		}
		
		//Make sure not selling more than I have.
		$this->bot->total_btc_can_sell = ($this->bot->btc < $sellLimitBtc) ? $this->bot->btc : $sellLimitBtc;
		$this->bot->total_usd_can_sell = $totes - ($totes * $fee);
		
	}
	
	//The main purpose for this function to make sure that there 
	//is enough money in the account to cover fees, and generate
	//triggers.
	public function setTriggers(){
		
		$sellCost = ($this->bot->sell_limit_btc * $this->ticker->last); 
		$buyCost = ($this->bot->buy_limit_btc * $this->ticker->last);
		
		$sellFee = $sellCost * $this->bot->exchange_fee;
		$buyFee = $buyCost * $this->bot->exchange_fee;
		
		$totalSellCost = $sellCost + $sellFee;
		
		$totalBuyCost = ($this->bot->usd > $totalSellCost) ? $this->bot->usd : $totalSellCost;
		//$totalBuyCost = $buyCost + $buyFee;
		
		$fixedSellCost = ($this->bot->sell_limit_btc * $this->bot->fixed_sell_amount);
		$fixedBuyCost = ($this->bot->buy_limit_btc * $this->bot->fixed_buy_amount);
		
		$fixedSellFee = $fixedSellCost * $this->bot->exchange_fee;
		$fixedBuyFee = $fixedBuyCost * $this->bot->exchange_fee;
		
		$totalFixedBuyCost = $fixedBuyCost + $fixedBuyFee;
		$totalFixedSellCost = $fixedSellCost + $fixedSellFee;
		
		return  array(
	               'sellCost'=>$sellCost,
	               'buyCost'=>$buyCost,
	               'sellFee'=>$sellFee,
	               'buyFee'=>$buyFee,
	               'totalSellCost'=>$totalSellCost,
	               'totalBuyCost'=>$totalBuyCost,
	               'fixedSellCost'=>$fixedSellCost,
	               'fixedBuyCost'=>$fixedBuyCost,
	               'fixedSellFee'=>$fixedSellFee,
	               'fixedBuyFee'=>$fixedBuyFee,
	               'totalFixedBuyCost'=>$totalFixedBuyCost,
	               'totalFixedSellCost'=>$totalFixedSellCost
		);
	}
	
	
	/**
	 * This is a really long and verbose function that simply
	 * checks business rules for transactions. Also includes 
	 * a butt-ton of comments.
	 */
	public function checkTransactionRules(){
		
		print_r($this->bot);
		
		LOG::info("\n\n*****************************************************\n");
		
		
		$buyTotal = 0;
		$sellTotal = 0;
		
		//echo "    PPP is " .$this->bot->ppp . "\n";
		//print_r($this->bot);
		

		if($this->bot->ppp > $this->ticker->last)
		{
			LOG::info("    PPP is " . $this->bot->ppp);
			LOG::info("    Purchase price has been reached. Buy total +1");
			$buyTotal += 1;
		}
		else{
			LOG::info( "PURCHASE PRICE NOT REACHED.\n     PPP = " . $this->bot->ppp  . "\nLast = " . $this->ticker->last);
		}
		
		if($this->bot->usd >= $this->bot->total_usd_can_purchase )
		//if($this->bot->usd <=  $this->bot->triggers["totalBuyCost"])
		{
			LOG::info("    There is enough USD available. Buy total +1.");
			$buyTotal += 1;
		}else{
			LOG::info("NOT ENOUGH USD AVAILABLE \n     Usd = " . $this->bot->usd . "\n     Total Buy cost: " . $this->bot->total_usd_can_purchase );
		}
		
		if($this->ticker->direction == 1)
		{
			LOG::info("Direction is increasing. Buy total +1");
			$buyTotal += 1;
		}
		else{
			LOG::info("WRONG DIRECTION.\n     Direction = " . $this->ticker->direction);
		}
		
		if($this->bot->can_buy)
		{
			LOG::info("Bot can buy. Buy total +1");
			$buyTotal += 1;
		}else{
			LOG::info("BOT HAS NO BUY PERMISSION");
		}
		
		if($this->bot->total_usd_can_purchase > 0)
		{
			LOG::info("Total cost is greater than 0. Buy total +1 (Protect against $0 transaction)");
			$buyTotal += 1;
		}else{
			LOG::info("COST OF PURCHASE IS ZERO.\n     Total buy Cost = " . $this->bot->total_usd_can_purchase . "\n");
		}
		
		if($buyTotal == 5)
		{
			LOG::info("\n****  TRIGGERING PURCHASE  ****");
		}
		else
		{
			LOG::info("\n***  CONDITIONS FOR PURCHSASE NOT MET.  **");
		}

        LOG::info("\n@@@@@@@@@@@@@@@@");

		if($this->bot->spp < $this->ticker->last)
		{
			LOG::info("SPP is " . $this->bot->spp);
			LOG::info("Sell price point met. Sell total +1");
			$sellTotal += 1;
		}
		else{
			LOG::info("SELL PRICE NOT MET.\n     Spp = " . $this->bot->spp . "\nLast = " . $this->ticker->last);
		}
		
		if( $this->bot->btc >= $this->bot->total_btc_can_sell)
		{
			LOG::info("Have enough btc. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("NOT ENOUGH BITCOIN TO SELL.\n     Btc = " . $this->bot->btc . "\n     Sell Limit Btc = " . $this->bot->total_btc_can_sell);
		}
		
		
		if($this->ticker->direction == -1)
		{
			LOG::info("Direction is decreasing. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("WRONG DIRECTION.\n     Direction = " . $this->ticker->direction);
		}
	
		
		if($this->bot->can_sell)
		{
			LOG::info("Bot can sell. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("BOT HAS NO SELL PERMISSIONS");
		}
		
		if($this->bot->total_btc_can_sell > 0)
		{
			LOG::info("Sell order is greater than zero. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("SELL ORDER IS ZERO.\n     Total Sell Cost = " . $this->bot->total_btc_can_sell );
		}
		
		if($sellTotal == 5)
		{
			LOG::info("\n**** TRIGGERING PURCHASE ****");
		}
		else
		{
			LOG::info("\n****  CONDITIONS FOR SALE NOT MET  ****");
		}

		
		LOG::info("Sell total = " . $sellTotal);
		LOG::info("BuyTotal = " . $buyTotal);
		
		LOG::info("\n*****************************************************\n");
		
		
		
		if($buyTotal == 5)
		{
			echo "\nTriggering buy transaction\n";
			
			LOG::info("\n********************************************************\n");
			LOG::info ("*******************************  CREATING BUY TRANSACTION\n");
			LOG::info("********************************************************\n");
			$this->createBuyTransaction();
		}
		else if($sellTotal == 5)
		{
			echo "\nTriggering sell transaction\n";
			
			LOG::info("\n********************************************************\n");
			LOG::info("*******************************  CREATING SELL TRANSACTION\n");
			LOG::info("********************************************************\n");
			$this->createSellTransaction();
		}
		
		
		/** end auto triggers **/
		
        //Should not need the fixed transactions. Should just need a check.
        /*
		else if($this->bot->fixed_sell == 1 && 
		        $this->bot->fixed_sell_amount > 0  && 
		        $this->ticker->last >= $this->bot->triggers["fixedSellCost"] )
		{
		    LOG::info("******************************* CREATING FIXED SELL TRANSACTION\n");
			
			$this->createSellTransaction();
			//disableFixedTransaction("s", $this->bot->getId());
		}
		else if($this->bot->fixed_buy == 1 && 
		        $this->bot->fixed_buy_amount <= $this->bot->usd && 
		        $this->bot->buy_limit_btc > 0 && $this->ticker->last < $this->bot->triggers["fixedBuyCost"] )
		{
			LOG::info ("*******************************  CREATING FIXED BUY TRANSACTION\n");
			
			$this->createBuyTransaction();
			//disableFixedTransaction("b", $this->bot->getId());
		}
		 */

	}

    public function createSellTransaction(){
    	
		print_r($this->bot);
    	
		LOG::info("* Creating Sell Transaction for bot: " . $this->bot->id . "\n");
		//limit is actual order size in btc
		
		$cost = ($this->bot->total_btc_can_sell * $this->ticker->last); 
		
		echo("Cost = " . $cost . "\n");
		echo("usd before = " . $this->bot->usd . "\n");
	    echo("btc before = " . $this->bot->btc . "\"n");
		
		if($this->bot->testing_mode == 1){
					
			$this->bot->usd += $cost;
			$this->bot->btc -= $this->bot->total_btc_can_sell;	
			
			echo("usd after = " . $this->bot->usd . "\n");
	        echo("btc after = " . $this->bot->btc . "\n");
	
			$response = DB::table('test_ledger')
            ->where('owner_id', $this->bot->owner_id)
            ->update(array(
                        'usd' => $this->bot->usd,
                        'btc' => $this->bot->btc

					));
			
			$response = DB::table('bot')
				            ->where('id', $this->bot->id)
				            ->update(array(
				                        'fixed_sell' => 0
					));	

			
		}else{
			//TODO: add bitstamp logic
		}
		
		
		/*			
		$balance = DB::table('member')->where('id', $this->bot->owner_id)->pluck("balance");
		$balance = $balance[0];
		
		$response = DB::table('member')
				            ->where('id', $this->bot->owner_id)
				            ->update(array(
				                        'balance' => ((int)$balance - 100000),

					));
		 * */

    }
	
	public function createBuyTransaction(){
		
		print_r($this->bot);
		
	
		
		LOG::info(" ### Creating Buy Transaction for bot: " . $this->bot->id);
		
		$cost = $this->bot->total_usd_can_purchase;
		
		echo("COST: " . $cost . "\n");
		
		echo("usd before = " . $this->bot->usd . "\n");
	    echo("btc before = " . $this->bot->btc . "\n");
		
		if($this->bot->testing_mode == 1){
			
			$this->bot->usd = $this->bot->usd - $cost;
			$this->bot->btc += $this->bot->total_btc_can_purchase;
			
			echo("usd after = " . $this->bot->usd . "\n");
	        echo("btc after = " . $this->bot->btc . "\n");
			
			
			$response = DB::table('test_ledger')
            ->where('owner_id', $this->bot->owner_id)
            ->update(array(
                        'usd' => $this->bot->usd,
                        'btc' => $this->bot->btc
					));
					
			LOG::info("test_ledger update = " . $response);
					
			$response = DB::table('bot')
				            ->where('id', $this->bot->id)
				            ->update(array(
				                        'fixed_buy' => 0
					));
				
			LOG::info("Bot update response = " . $response);	
			 
			
		}else{
			//TODO: add bitstamp logic
		}
		
		/*
		$balance = DB::table('member')->where('id', $this->bot->owner_id)->pluck("balance");
		$balance = $balance[0];
		
		$response = DB::table('member')
				            ->where('id', $this->bot->owner_id)
				            ->update(array(
				                        'balance' => ((int)$balance - 100000),

					));
		
		*/
	}
	
	//doesnt belong here, but don't wqant to create a separate class yet.
	public function updateHistory(){
					
        $usd = $this->bot->btc * $this->ticker->previous + $this->bot->usd;
		$date = date("y/m/d");
		
		//if usd us higher than history
		//$history = 
		
		
		$high = str_replace(",", "", number_format($usd,2));
		$low = str_replace(",", "", number_format($usd,2));				
			
		
					
		$historicalData = array(
						    'high'=> $high,
						    'low'=> $low,
						    'date_low'=>$date,
						    'date_high'=>$date,
						    'start_usd'=>$this->bot[0]->usd,
						    'start_btc'=>$this->bot[0]->btc,
						    'owner_id'=>$this->id,
						    'currency'=>"BTC"
						);		
			
		
	}
	
	public function getTransactions(Request $request){
		
		if( Session::get('session') == $request->session &&
		    Session::get('token') == $request->token &&
			Session::get('authenticated') ){
				
				$owner_id = Crypt::decrypt($request->owner_id);
				
				$result = (array)$balance = DB::table('transaction')->where('owner_id', $owner_id)->get();
				
				
				return json_encode( array('transactions'=>$result) );
			}
	}


}
	