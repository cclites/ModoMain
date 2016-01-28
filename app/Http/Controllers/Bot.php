<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class Bot extends Controller{
	
	private $token;
	private $session;
	
	public function getBotState(Request $request){
		
		$this -> token = $request -> token;
		$this -> session = $request -> session;
		
		if( Session::get('session') == $this->session &&
		    Session::get('token') == $this->token &&
			Session::get('authenticated') ){  //valid. Get the associated bot.
			
			$id = DB::table('member')->where('token', $this->token)->pluck("id");
			$bot = DB::table('bot')->where('owner_id', $id)->get();
			
			//LOG::info("Bot length is " . count($bot) );
			
			//return json_encode( array("bot"=>$bot) );
			
			$botId = $bot[0]->id;
			
			//before I send this back, I want to encode the owner id and id.
			$bot[0]->id = Crypt::encrypt($bot[0]->id);
			$bot[0]->owner_id = Crypt::encrypt($bot[0]->owner_id);
			
			$bot[0]->id = htmlentities($bot[0]->id);
			$bot[0]->owner_id = htmlentities($bot[0]->owner_id);
			
			
			$balance = DB::table('member')->where('id', $id[0])->pluck("balance");
			$balance = $balance[0];
	
			//TODO remove hard coded trade divisor
			$bot[0]->trades = $balance;
			

			if($id[0] == 64){
				$bot[0]->testing_mode = 1;
			}
			
			if($bot[0]->testing_mode == 1){
				
				//LOG::info("Bot id is " . $id[0]);
				
				$result = DB::table('test_ledger')->where('owner_id', $id)->get();
				
				//LOG::info( gettype($result) );
				//return json_encode( array("test ledger result"=>$result) );
				
				$bot[0]->usd = $result[0]->usd;
				$bot[0]->btc = $result[0]->btc;
				
			}

			return json_encode( array("bot"=>$bot) );
					
		}else{

			return json_encode( array('bot'=> 0) );
		}
		
		
	}

	public function updateConfigs(Request $request){
		
		//echo "Client side configs\n";
		//print_r($request);
		//return;
		//LOG::info("FIXED SELL AMOUNT " . $request->fixed_sell_amount);
		//LOG::info("FIXED BUY AMOUNT " . $request->fixed_buy_amount);
		
	    $token = $request -> token;
		$session = $request -> session;
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
			//LOG::info(">" . $token . "<");
				
			$id = DB::table('member')->where('token', $request -> token )->pluck("id");
			$id = $id[0];
			
			//LOG::info($request->is_active);
			//LOG::info($request->testing_mode);
			//LOG::info($request->buying);
			//LOG::info($request->selling);
			//LOG::info($request->fixed_sell);
			//LOG::info($request->fixed_buy);
				
            $configs = array();

			$configs["is_active"] = ($request->is_active == "true") ? 1 : 0;
			$configs["testing_mode"] = ($request->testing_mode == "true") ? 1 : 0;
			$configs["buying"] = ($request->buying == "true") ? 1 : 0;
			$configs["selling"] = ($request->selling == "true") ? 1 : 0;
			$configs["fixed_sell"] = ($request->fixed_sell == "true") ? 1 : 0;
			$configs["fixed_buy"] = ($request->fixed_buy == "true") ? 1 : 0;
			
			
			$configs["fixed_sell_amount"] = str_replace(",", "", $request->fixed_sell_amount);
			$configs["fixed_buy_amount"] = str_replace(",", "", $request->fixed_buy_amount);
			
			
			$configs["base"] = str_replace(",", "", $request->base);
			
			if($id == 38){ //hard coded public test model
			  $configs["testing_mode"] = 1;
			}
			
			//$s = print_r($configs, true);
			//LOG::info("CONFIGS: " . $s);
			
			$response = DB::table('bot')
            ->where('owner_id', $id)
            ->update(array(
                        'base' => $configs["base"],
                        'is_active' => $configs["is_active"],
                        'testing_mode' => $configs["testing_mode"],
                        'can_buy' => $configs["buying"],
                        'can_sell' => $configs["selling"],
                        'fixed_sell' =>$configs["fixed_sell"],
                        'fixed_buy' => $configs['fixed_buy'],
						'fixed_sell_amount' => $configs["fixed_sell_amount"],
						'fixed_buy_amount' => $configs["fixed_buy_amount"],
						'sell_limit_btc' => $request->sellLimitBtc,
						'buy_limit_btc' => $request->buyLimitBtc,
						'increase' =>$request->increase/100,
						'decrease'=>$request->decrease/100
					));
			
	        return json_encode( array('status'=>$response) );
		}
	}
	
	
	//Main entry point for updating bots via daemon
	public function processBotRules($bots){

        LOG::info("Processing bot rules");

        $id = 1;

		$ticker = app('App\Http\Controllers\Ticker')->getTickerById($id);

		for($i=0; $i<count($bots); $i += 1){
			
			$bots[$i] = $this->calculatePricePoints($bots[$i]);
			$bots[$i] = app('App\Http\Controllers\Transaction')->updateTransaction($bots[$i], $ticker);
			
		}
		
		echo "Finished processing";
	}

    public function getAllActiveBots(){
    	
		
		LOG::info("Getting all active bots.\n");
    	
		//$bots = DB::table('bot')->where('owner_id', 1)->get();
		//actually get all active bots
		$bots = DB::table('bot')->where('is_active', 1)->get();
		
		//return $this->cacluclatePricePoints()
		for($i=0; $i<count($bots); $i += 1){
			
			//TODO: There is a function identical to this. Refactor.
			if($bots[$i]->testing_mode == 1){
				
				$result = DB::table('test_ledger')->where('owner_id', $bots[$i]->owner_id )->get();
				
				$bots[$i] = $this->calculatePricePoints($bots[$i]);
				
				$bots[$i]->usd = $result[0]->usd;
				$bots[$i]->btc = $result[0]->btc;
				
			}
			
		}
		
		//$bots = DB::table('bot')->where('is_active', 1)->get(); 
        return $bots;
    }
	

	function calculatePricePoints($bot){
		
		LOG::info("Calculating price points");
		
		$base = $bot->base;
		$increase = $bot->increase;
		$decrease = $bot->decrease;
		
		$bot->spp = $base * (1 + $increase);
		$bot->ppp = $base * (1 - $decrease);
		
		/*
		$bot->spp = ( $base + ($base * ($increase/10) ) );
		$bot->ppp = ( $base - ($base * ($increase/10) ) );
		 * 
		 */
		
		return $bot;
	}
}
