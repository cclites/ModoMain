<?php

pingSite();

function pingSite(){
	
	echo("Pinging Site\n");
	
	$url = "http://localhost/ModoMain/public/daemon";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	
	if(curl_errno($ch))
	{
	    echo 'error:' . curl_error($ch) . "\n";
	}
	
	echo "$result\n";
	curl_close($ch);
	
	echo "Sleeping\n";
	sleep(65);
	
	pingSite();
}


?>