<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use DB;
use Crypt;
use Illuminate\Support\Facades\Session;

class Sweeper extends Controller{
	
	/*
	 * Uses API from blockcypher.com, FTW
	 */
	private $result;
	
	public function sweep(){
		
       //get a list of all wallets addresses that need to be swept.
       $wallets = DB::table('wallet')->where('sweep', 1)->pluck("addr");
	   
	   echo("\n\n################################################\n");

	   echo ( count($wallets) . "\n" );
	   
	   print_r($wallets);
	   echo "\n";
	   
	   //Now that I have the wallets, get the balances for each
	   if( count($wallets) > 0){
	   	
		    for($i = 0; $i< count($wallets); $i += 1){

				$bal = $wallets[$i];
				
				$newBal = preg_replace("/\s+|[[:^print:]]/", "", $bal);
		    	$url = "https://api.blockcypher.com/v1/btc/main/addrs/$newBal/balance";
				$this->_query($url);
				
				//$this->result = json_decode($this->result);
				print_r($this->result);
				
				$this->processBalanceQuery( json_decode($this->result) );
				
		    }
		
		    //now ping the blockchain and see what happens
		   
		    
	   }
	   
	   echo("\n################################################\n\n");
		
	}
	
	public function _query($url){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		
		$this->result = curl_exec($ch);

		if(curl_errno($ch))
		{
		    echo 'error:' . curl_error($ch) . "\n";
		}
		
		curl_close($ch);
	}
	
	//result represents the object being returned from the addr api call
	public function processBalanceQuery($balance){
		
		echo "Processing balance query\n";

		$addr = $balance->address;
		
		$balance->balance = 500000;
		$balance->n_tx = 1;
		
        $wallets = DB::table('wallet')->where('sweep', 1)->get();
		
		for ($i=0; $i< count($wallets); $i += 1){
			
			if( (strpos( $wallets[$i]->addr, $addr) !== false)  ){
				
				$bal = $balance->balance;
				$n_tx = $balance->n_tx;
				
				echo "Balance is $bal\n";
				echo "n_tx is $n_tx\n";
				
				if( $bal > 0 && $n_tx > 0 ){
					
					echo "testing balance\n";
					
					$owner_id = $wallets[$i]->owner_id;

					$response = DB::table('wallet')
					            ->where('owner_id', $owner_id)
					            ->update(array(
					                        'sweep' => 0
								));	
								
					print_r($response);
					echo "\n";
												
					//calculate how many credits there are available based ont he balance.
					//Not sure how the balance will be returned for sure though.
					$playsBalance = $bal/100000;
					
					echo $playsBalance . "\n";
					
					$response = DB::table('member')
					            ->where('id', $owner_id)
					            ->update(array(
					                        'balance' => $playsBalance
								));
					
					print_r($response);
					echo "\n";
				}
				
			}else{
				echo ( "**    " . $addr . " = " . $wallets[$i]->addr . "\n");
				echo "Addresses do not match.\n";
				
				
			}
			
			/*
			if(  $addr  == $wallets[$i]->addr){
			    
			}else{
				echo "Wallets[i] " . $wallets[$i]->addr . "\n";
				echo "addr " . $addr . "\n";
				echo ( "**    " . $addr . " = " . $wallets[$i]->addr . "\n");
				echo "Addresses do not match.\n";
			}
            */
			
		}
		
		
		

	}
	
	
	
}
