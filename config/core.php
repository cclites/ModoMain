<?php
	//echo Config::get('core.SEED');
	//Config::get('core.BASEPATH');
	return [
	    'SEED' => '636861646c6f7665737374616379',
	    "BITSTAMP_GET_TICKER"=>"https://www.bitstamp.net/api/v2/ticker/btcusd/",
	    "BITSTAMP_GET_TICKER_USD"=>"https://www.bitstamp.net/api/v2/ticker/btcusd/",
	    "BITSTAMP_GET_TICKER_EUR"=>"https://www.bitstamp.net/api/v2/ticker/btceur/",
	    "BITSTAMP_GET_BALANCE"=> "https://www.bitstamp.net/api/balance/",
	    
		
		"BITSTAMP_GET_BALANCE_USD"=>"https://www.bitstamp.net/api/v2/balance/btcusd/",
	    "BITSTAMP_GET_BALANCE_EUR"=>"https://www.bitstamp.net/api/v2/balance/btceur/",
		
		//https://www.bitstamp.net/api/v2/balance/btceur/
		
	    "BITSTAMP_BUY_LIMIT"=>"https://www.bitstamp.net/api/buy/",
	    "BITSTAMP_SELL_LIMIT"=> "https://www.bitstamp.net/api/sell/",
	    "BITSTAMP_OPEN_ORDERS"=>"https://www.bitstamp.net/api/open_orders/",
	    "BITSTAMP_CLOSE_ORDER"=>"https://www.bitstamp.net/api/cancel_order/",
	    "BITSTAMP_TRANSACTIONS"=>"https://www.bitstamp.net/api/user_transactions/",
	    "SWEEP_ONCE"=>true,
	    "BASEPATH"=>"localhost/ModoMain/public",
	];