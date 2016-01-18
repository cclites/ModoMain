<?php

namespace App\Libraries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use Illuminate\Support\Facades\Session;


class AuthenticateHandler extends Controller {

	private $uPass;
	private $uName;
	public $token;
	public $session;
	public $registered = false;
	public $message = "Invalid Credentials.";
	public $userId = null;

	public function __construct(Request $request) {

		$this -> uPass = $request -> uname;
		$this -> uName = $request -> upass;
		
		//LOG::info("upass is " . $this -> uPass);
		//LOG::info("uname is " . $this -> uName);
 
	}

	function authenticate() {
		
		//Server side sanity check
		if (!$this -> uName || !$this -> uPass)
			return json_encode( array('uname'=> $this -> uName, 'upass'=>$this -> uPass) );

		$token = "";
		$token = $this -> createToken();
		$this -> token = $token;
		
		//LOG::info("token is " . $this -> token);
		
		//
		$member = new Member();
		$record = $member -> getMemberInfo($token);
		
		//LOG::info("Record type is " . gettype($record));

		if ( gettype($record) === "object" ) {
			//writeLog("Member exists", AUTHENTICATE);

			$this -> message = "Credentials Validated.";
			$this -> registered = true;

			//************************************
			//****  Prevent session hijacking ****
			//************************************
			//Session::put('someKey', 'someValue');
			
            Session::put('authenticated', true);
			Session::put('token', $token);

			$this->userId = $record->id;
			$toEncrypt = $record->id . "|" . $this -> token . "|" . time();
			$encryptedSession = $this->eCrypt($toEncrypt );
			$this->session = $encryptedSession;
			
			Session::put('session', $encryptedSession);
			

			return json_encode( array('token'=>$this->token, 'session'=>Session::get('session') ) );
		} else {
			//writeLog("Member does not exist", AUTHENTICATE);
			return json_encode( array('status'=>0) );
		}
	}

	function createToken(){
		
		$token = $this -> uName . config('core.SEED') . $this -> uPass;

		//echo "Raw token is $token\n";

		for ($i = 0; $i < 100000; $i += 1) {
			$token = hash("sha256", $token, false);
		}

		return hash("sha256", $token, false);

	}

	function eCrypt($toEncrypt) {
		//LOG::error("ENCRYPT SEED IS " . config('core.SEED'));
		
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);

		return base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash('sha256', config('core.SEED'), true), $toEncrypt, MCRYPT_MODE_CBC, $iv));
	}

	function dCrypt($toDecrypt) {
		$data = base64_decode($toDecrypt);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));
		
		//LOG::error("DECRYPT SEED IS " . config('core.SEED'));

		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, hash('sha256', config('core.SEED'), true), substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv), "\0");

	}

}
