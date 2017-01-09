<?php

class Curl{

/*********************************************************************
*  Wrapper to allow reuse of the curl functionality for GET requests.
*
*  Parameters:
*  $result			- represents the ticker object
*  $url				- represents the REST request
*********************************************************************/

//NOTE: Clearly not a curl. Don't recall why the change.
function _get($url)
{
	$file = file_get_contents($url);
	return (array)$file;
	//return $file;
	
	/*
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = json_decode(curl_exec($ch));
	curl_close($ch);
	return $result;
	*/ 
	 
}

/*********************************************************************
*  Wrapper to allow reuse of the curl functionality for POST requests.
*
*  Parameters:
*  $result      - represents the ticker object
*  $str         -
*  $url         - represents the REST request
**********************************************************************/
function _post($url, $str)
{
	echo "Curling.<br>";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_HEADER,0);          // DO NOT RETURN HTTP HEADERS
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$result = json_decode(curl_exec($ch), true);
	return result;
}

}
