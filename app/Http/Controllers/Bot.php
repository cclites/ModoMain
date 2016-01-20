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
			
			$botId = $bot[0]->id;
			
			//before I send this back, I want to encode the owner id and id.
			$bot[0]->id = Crypt::encrypt($bot[0]->id);
			$bot[0]->owner_id = Crypt::encrypt($bot[0]->owner_id);
			
			
			$balance = DB::table('member')->where('id', $id[0])->pluck("balance");
			$balance = $balance[0];
	
			//TODO remove hard coded trade divisor
			$bot[0]->trades = $balance/100000;
			
			//LOG::info("id is " . $id[0]);
			
			//LOG::info($bot[0]->testing_mode);
			if($id[0] == 64){
				$bot[0]->testing_mode = 1;
			}
			
			//if the bot is in test mode, then need to get 
			//values from test_ledger table
			if($bot[0]->testing_mode){
				
				$result = DB::table('test_ledger')->where('owner_id', $botId)->get();
				
				$bot[0]->usd = $result[0]->usd;
				$bot[0]->btc = $result[0]->btc;
				
			}
			
			
			return json_encode( array("bot"=>$bot) );
					
		}else{

			return json_encode( array('bot'=> 0) );
		}
		
		
	}

	public function updateConfigs(Request $request){
		
	    $token = $request -> token;
		$session = $request -> session;
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
			LOG::info(">" . $token . "<");
				
			$id = DB::table('member')->where('token', $request -> token )->pluck("id");
			$id = $id[0];
			
			LOG::info($request->is_active);
			LOG::info($request->testing_mode);
			LOG::info($request->buying);
			LOG::info($request->selling);
			LOG::info($request->fixed_sell);
			LOG::info($request->fixed_buy);
				
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
			
			$s = print_r($configs, true);
			LOG::info("CONFIGS: " . $s);
			
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
						'fixed_buy_amount' => $configs["fixed_buy_amount"]
					));
			
	        return json_encode( array('status'=>$response) );
		}
	}
	
	
}
