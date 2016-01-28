<?php

pingDaemon();
//pingSweeper();



function pingDaemon(){
	
    echo "Daemon is running\n";
	
	$url = "http://localhost/ModoMain/public/daemon";
	_ping($url);

	echo "Daemon Sleeping\n";
	sleep(65);
	
	//pingDaemon();
	//pingSweeper();
}


function pingSweeper(){
	
	echo "Sweeper is running\n";
	
	$url = "http://localhost/ModoMain/public/sweep";
	
	print_r( _ping($url) );
	
	echo "Sweeper Sleeping\n";
	//sleep(30);
	
	//pingSweeper();
}

function _ping($url){
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	
	echo "ping\n";
	print_r($result);
	
	if(curl_errno($ch))
	{
	    echo 'error:' . curl_error($ch) . "\n";
	}
	
	curl_close($ch);
	
	return $result;
}

?>