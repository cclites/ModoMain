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
		
		
		$this->bot->triggers = $this->setTriggers();
		//echo "2<br>";
		//print_r($this->bot);
		
		
		$this->checkTransactionRules();
		//echo "3<br>";
		//print_r($this->bot);
		
		//return;
    	return $this->bot;
    }
	
	public function setTransactionLimits(){
		
		$bLimit = $this->bot->buy_limit_btc;
		$sLimit = $this->bot->sell_limit_btc;
		$usd = $this->bot->usd;
		$btc = $this->bot->btc;
		$last = $this->ticker->last;
		
		
		if($bLimit == 0){
			$bLimit = $usd/$last;
		}elseif(($bLimit * $last) >= $usd){
			$bLimit = $usd/$last;
		}
		
		if($sLimit == 0){ 
			$sLimit = $btc;
		}else if( $btc < $sLimit){
			$sLimit = $btc;
		}
		
		$this->bot->buy_limit_btc = $bLimit;
		$this->bot->sell_limit_btc = $sLimit;
		
		return $this->bot;
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
		$totalBuyCost = $buyCost + $buyFee;
		
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
		
		
		$buyTotal = 0;
		$sellTotal = 0;
		
		/** Check conditions for purchase **/
		if($this->bot->ppp < $this->ticker->last)
		{
			LOG::info("Purchase price has been reached. Buy total +1");
			$buyTotal += 1;
		}
		else{
			LOG::info("PURCHASE PRICE NOT REACHED");
		}
		
		if($this->bot->usd >=  $this->bot->triggers["totalBuyCost"])
		{
			LOG::info("There is enough USD available. Buy total +1.");
			$buyTotal += 1;
		}else{
			LOG::info("NOT ENOUGH USD AVAILABLE");
			//total buy cost
			LOG::info("    Total buy cost " . $this->bot->triggers["totalBuyCost"] );
			LOG::info("    Total usd available " . $this->bot->usd );
		}
		
		if($this->ticker->direction == 1)
		{
			LOG::info("Direction is increasing. Buy total +1");
			$buyTotal += 1;
		}
		else{
			LOG::info("WRONG DIRECTION");
		}
		
		if($this->bot->can_buy)
		{
			LOG::info("Bot can buy. Buy total +1");
			$buyTotal += 1;
		}else{
			LOG::info("BOT HAS NO BUY PERMISSION");
		}
		
		if($this->bot->triggers["totalBuyCost"] > 0)
		{
			LOG::info("Total cost is greater than 0. Buy total +1 (Protect against $0 transaction)");
			$buyTotal += 1;
		}else{
			LOG::info("COST OF PURCHASE IS ZERO");
		}
		
		if($buyTotal == 5)
		{
			LOG::info("**********All conditions met for purchase. Trigger sale.......\n\n");
		}
		else
		{
			LOG::info("CONDITIONS FOR PURCHSASE NOT MET.");
		}
		/** End check purchase transactions **/
		
		
		
		/** Check conditions for sale **/
		if($this->bot->spp > $this->ticker->last)
		{
			LOG::info("Sell price point met. Sell total +1");
			$sellTotal += 1;
		}
		else{
			LOG::info("SELL PRICE NOT MET");
		}
		
		if( $this->bot->btc >= $this->bot->sell_limit_btc )
		{
			LOG::info("Have enough btc. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("NOT ENOUGH BITCOIN TO SELL");
		}
		
		
		if($this->ticker->direction == -1)
		{
			LOG::info("Direction is decreasing. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("WRONG DIRECTION");
		}
	
		
		if($this->bot->can_sell)
		{
			LOG::info("Bot can sell. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("BOT HAS NO SELL PERMISSIONS");
		}
		
		if($this->bot->triggers["totalSellCost"] > 0)
		{
			LOG::info("Sell order is greater than zero. Sell total +1");
			$sellTotal += 1;
		}else{
			LOG::info("SELL ORDER IS ZERO");
		}
		
		if($sellTotal == 5)
		{
			LOG::info(" *********** All conditions met for sale. Trigger purchase.");
		}
		else
		{
			LOG::info("CONDITIONS FOR SALE NOT MET");
		}
		/** end check sale transactions **/
		
		
		/** trigger auto transactions **/
		if($buyTotal == 5)
		{
			LOG::info ("CREATING BUY TRANSACTION\n");
			$this->createBuyTransaction();
		}
		else if($sellTotal == 5)
		{
			LOG::info("CREATING SELL TRANSACTION\n");
			$this->createSellTransaction();
		}
		/** end auto triggers **/
		

		else if($this->bot->fixed_sell == 1 && 
		        $this->bot->fixed_sell_amount > 0 && 
		        $this->ticker->last >= $this->bot->triggers["fixedSellCost"] )
		{
		    LOG::info("CREATING FIXED SELL TRANSACTION\n");
			
			$this->createSellTransaction();
			//disableFixedTransaction("s", $bot->getId());
		}
		else if($this->bot->fixed_buy == 1 && 
		        $this->bot->fixed_buy_amount <= $this->bot->usd && 
		        $this->bot->buy_limit_btc > 0 && $this->ticker->last < $this->bot->triggers["fixedBuyCost"] )
		{
			LOG::info ("CREATING FIXED BUY TRANSACTION\n");
			
			$this->createBuyTransaction();
			//disableFixedTransaction("b", $bot->getId());
		}
		
		
		
	}

    public function createSellTransaction(){
    	
		LOG::info("Creating Sell Transaction for bot: " . $this->bot->id);
		//limit is actual order size in btc
		
		$cost = ($this->bot->sell_limit_btc * $this->ticker->last);  
		
		if($this->bot->testing_mode == 1){
			
			//update balance
			$this->bot->usd += $cost;
			$this->bot->btc -= $this->bot->sell_limit_btc;
			
			$response = DB::table('test_ledger')
            ->where('owner_id', $this->bot->id)
            ->update(array(
                        'usd' => $this->bot->usd,
                        'btc' => $this->bot->btc

					));
			
			$response = DB::table('bot')
				            ->where('id', $this->bot->id)
				            ->update(array(
				                        'fixed_sell' => 0,
				                        'base'=>$this->ticker->last
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
		
		LOG::info("Creating Buy Transaction for bot: " . $this->bot->id);
		
		$cost = ($this->bot->sell_limit_btc * $this->ticker->last); 
		
		if($this->bot->testing_mode == 1){
			
			$this->bot->usd -= $cost;
			$this->bot->btc += $this->bot->buy_limit_btc;
			
			$response = DB::table('test_ledger')
            ->where('owner_id', $this->bot->id)
            ->update(array(
                        'usd' => $this->bot->usd,
                        'btc' => $this->bot->btc

					));
					
			$response = DB::table('bot')
				            ->where('id', $this->bot->id)
				            ->update(array(
				                        'fixed_buy' => 0,
				                        'base'=>$this->ticker->last
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
						    'start_usd'=>$bot[0]->usd,
						    'start_btc'=>$bot[0]->btc,
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
	