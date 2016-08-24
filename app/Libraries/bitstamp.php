<?php



//use DB;
//use Log;


namespace App\Libraries;

//use \App\Http\Controllers\Controller;


/**
 * @package Bitstamp API
 * @author https://bxmediaus.com - BX MEDIA - PHP + Bitcoin. We are ready to work on your next bitcoin project. Only high quality coding. https://bxmediaus.com
 * @version 0.1
 * @access public
 * @license http://www.opensource.org/licenses/LGPL-3.0
 */

class Bitstamp
{
    private $key;
    private $secret;
    private $client_id;
    public $redeemd;  // Redeemed code information
    public $withdrew; // Withdrawal information
    public $info;     // Result from getInfo()
    public $ticker;   // Current ticker (getTicker())
    public $eurusd;   // Current eur/usd
    /**
     * Bitstamp::__construct()
     * Sets required key and secret to allow the script to function
     * @param Bitstamp API Key $key
     * @param Bitstamp Secret $secret
     * @return
     */
    public function __construct($key, $secret, $client_id)
    {
        if (isset($secret) && isset($key) && isset($client_id))
        {
            $this->key = $key;
            $this->secret = $secret;
            $this->client_id = $client_id;
        } else
            die("NO KEY/SECRET/CLIENT ID");
    }
    /**
     * Bitstamp::bitstamp_query()
     * 
     * @param API Path $path
     * @param POST Data $req
     * @return Array containing data returned from the API path
     */
    public function bitstamp_query($path, array $req = array(), $currency)
    {
        // API settings
        $key = $this->key;

        // generate a nonce as microtime, with as-string handling to avoid problems with 32bits systems
        $mt = explode(' ', microtime());
        $req['nonce'] = $mt[1] . substr($mt[0], 2, 6);
        $req['key'] = $key;
        $req['signature'] = $this->get_signature($req['nonce']);


        // generate the POST data string
        $post_data = http_build_query($req, '', '&');

        // any extra headers
        $headers = array();

        // our curl handle (initialize if required)
        static $ch = null;
        if (is_null($ch))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT,
                'Mozilla/4.0 (compatible; MtGox PHP client; ' . php_uname('s') . '; PHP/' .
                phpversion() . ')');
        }
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		
		//Illuminate\Log\Writer::info("Querying for Bitstamp");
		//need to use a different url
	//Log::info("Logging");
	
	$newUrl = "";
	
	$newUrl = "https://www.bitstamp.net/api/v2/$path/btcusd/";
	
	if($currency == 'eur'){
	  $newUrl = "https://www.bitstamp.net/api/v2/$path/btceur/";
	}

	
	curl_setopt($ch, CURLOPT_URL, $newUrl);
	
       // curl_setopt($ch, CURLOPT_URL, 'https://www.bitstamp.net/api/' . $path .'/');
		
		
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // run the query
        $res = curl_exec($ch);
        if ($res === false)
            throw new \Exception('Could not get reply: ' . curl_error($ch));
        $dec = json_decode($res, true);
        if (!$dec)
            throw new \Exception('Invalid data received, please make sure connection is working and requested API exists');
        return $dec;
    }

    /**
     * Bitstamp::ticker()
     * Returns current ticker from Bitstamp
     * @return $ticker
     */
    function ticker() {
        $ticker = $this->bitstamp_query('ticker');
        $this->ticker = $ticker; // Another variable to contain it.
        return $ticker;
    }

    /**
     * Bitstamp::eurusd()
     * Returns current EUR/USD rate from Bitstamp
     * @return $ticker
     */
    function eurusd() {
        $eurusd = $this->bitstamp_query('eur_usd');
        $this->eurusd = $eurusd; // Another variable to contain it.
        return $eurusd;
    }

    /**
    * Bitstamp::buyBTC()
    *
    * @param float $amount
    */
    function buyBTC($amount){

      if (!isset($ticker))
        $this->ticker();

      $ticker = $this->ticker;

        return $this->bitstamp_query('buy', array('amount' => $amount, 'price' => $ticker['ask']));

    }

    /**
    * Bitstamp::sellBTC()
    *
    * @param float $amount
    * @param float $price
    * @param string $currency
    */
    function sellBTC($amount){

      if (!isset($ticker))
        $this->ticker();

      $ticker = $this->ticker;

        return $this->bitstamp_query('sell', array('amount' => $amount, 'price' => $ticker['bid']));

    }
	
	function withdraw($amount, $address){
		if(isset($amount) && isset($address))
		
		return $this->bitstamp_query('bitcoin_withdrawal', array('amount' => $amount, 'address' => $address));
	}


    /**
    * Bitstamp::get_signature()
    * Compute bitstamp signature
    * @param float $nonce
    */
    private function get_signature($nonce)
    {

      $message = $nonce.$this->client_id.$this->key;

      return strtoupper(hash_hmac('sha256', $message, $this->secret));

    }
		
		public function getSignature($nonce)
		{
		  return $this->get_signature($nonce);
		}
}