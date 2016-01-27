<?php

namespace App\Libraries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Member;
use Log;
use Crypt;
use DB;
use File;
use Illuminate\Support\Facades\Session;


class AuthenticateHandler extends Controller {

	private $uPass;
	private $uName;
	public $token;
	public $session;
	public $registered = false;
	public $message = "Invalid Credentials.";
	public $userId = null;

	public function __construct() {

	}

	function authenticate(Request $request) {
		
		$this -> uPass = $request -> upass;
		$this -> uName = $request -> uname;
		
		LOG::info($this->uPass);
		
		//Server side sanity check
		if (!$this -> uName || !$this -> uPass)
			return json_encode( array('uname'=> $this -> uName, 'upass'=>$this -> uPass) );

		$token = $this -> createToken();
		$this -> token = $token;
		
		LOG::info("Token in auth is " . $token);

		
		$member = new Member();
		$record = $member -> getMemberInfo($token);
		
		//TODO: make sure member has been validated, otherwise do not allow login
		if($record->activated == 0){
			return json_encode( array("status"=> "0", 'message'=>'Check your email inbox for a confirmation email. You will not be allowed to log in until your email address is verified.') );
		}

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
			
			$encryptedSession = htmlentities($encryptedSession);
			$this->token = htmlentities($this->token);
			
			Session::put('session', $encryptedSession);
			

			return json_encode( array('token'=>$this->token, 'session'=>Session::get('session') ) );
		} else {
			//writeLog("Member does not exist", AUTHENTICATE);
			return json_encode( array('status'=>0) );
		}
	}

	function createToken(){
	
		LOG::info("CREATE TOKEN");
		LOG::info($this->uName);
		LOG::info($this->uPass);
		
		$token = $this -> uName . config('core.SEED') . $this -> uPass;

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
	
	function updateLogin($request){
		
		$pass1 = $request -> pass1;
		$pass2 = $request-> pass2;
		
		$token = $request -> token;
		$session = $request -> session;
		
		LOG::info("upass1: " . $pass1);
		
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
			$id = Crypt::decrypt($request->owner_id);
			
			//LOG::info("token is $token");
			//LOG::info("session is $session");
			LOG::info("ID is $id");
			
			$result = DB::table('member')->where('token', $request -> token )->where('id', $id)->get();
			
			if($result == 0){
				
				return json_encode(array('status'=>$result, 'message'=>'Unable to change log-on credentials at the moment.'));
				
			}
			
			$this->uName = $result[0]->display_name;
			$this->uPass = $pass1;
			

			if( count($result) > 0 ){
				
				$newToken = $this->createToken();
				
				LOG::info("New token: $newToken");
				
				
				//now update the database
				$result = DB::table('member')->where('id', $id)
				          ->update(array(
		                        'token' => $newToken
							));
							
				return json_encode( array('status'=>$result) );
			}
		}

	}
	
	function updateEmail($request){
		
		$token = $request -> token;
		$session = $request -> session;
		$newMail = $request->newMail;
		
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
				$id = Crypt::decrypt($request->id);
				
				$result = DB::table('member')->where('token', $request -> token )->where('id', $id)->get();
				
				//save new email
				if( count($result) > 0 ){
					
					//now update the database
					$result = DB::table('member')->where('id', $id)
					          ->update(array(
			                        'email' => $newMail
								));
								
					return json_encode( array('status'=>$result) );
					
				}
		}	
	}
	
	function updateBsConfigs($request){
		
		$token = $request -> token;
		$session = $request -> session;
		$uId = $request-> uid;
		$uSecret = $request -> usecret;
		$uToken = $request -> utoken;
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
				$id = Crypt::decrypt($request->id);
				$result = DB::table('member')->where('token', $request -> token )->where('id', $id)->get();
				
				//save new email
				if( count($result) > 0 ){
					
					$token = json_encode( array( 'uid'=>$uId , 'usecret'=>$uSecret, 'utoken'=>$uToken) );
					$newToken = Crypt::encrypt( $token );
					
					//LOG::info("New Token is $newToken");
					
					//now update the database
					$result = DB::table('user')->where('owner_id', $id)
					          ->update(array(
			                        'api_key' => $newToken
								));
								
					return json_encode( array('status'=>$result) );
				}
			}
		
	}
			
	
	function activateAccount($request){
		
		$token = $request -> token;
		$session = $request -> session;
		
		LOG::info("Activating account");
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
				LOG::info("Valid account...");
				
				$id = Crypt::decrypt($request->id);
				$result = DB::table('member')->where('token', $request -> token )->where('id', $id)->get();
				
				if( count($result) > 0 ){
					//now update the database
					$result = DB::table('wallet')->where('owner_id', $id)
					          ->update(array(
			                        'sweep' => 1
								));
					
					return json_encode( array('status'=>$result) );
					
				}
				else{
					LOG::info("I don't know you.....");
				}
		}
	}
	
	function addNewUser($request){
		
		$umail = $request->umail;
		$this -> uName = $request->uname;
		$this -> uPass = $request->upass;
		
		$token = $this -> createToken();
		$this -> token = $token;

	
		//add user to the database.
		$owner_id = DB::table('member')->insertGetId(
		    ['email' => $umail, 'token' => $token, 'display_name'=>""]
		);
		
		//give it a bot
		DB::table('bot')->insert(
		    ['owner_id'=>$owner_id]
		);
		
		//add history
		DB::table('historic')->insert(
		    ['owner_id'=>$owner_id]
		);
		
		//add test ledger
		DB::table('test_ledger')->insert(
		    ['owner_id'=>$owner_id]
		);
		
		//add user
		DB::table('user')->insert(
		    ['owner_id'=>$owner_id]
		);
		
		//addValidator
		$validationToken = $this->eCrypt($umail . "|" . $this -> token . "|" . $owner_id);
		
		//Still not convinced that this table is needed.
		//add user
		DB::table('validation')->insert(
		    ['owner_id'=>$recordId, 'hash'=>$validationToken]
		);
		
		//assign wallet
		$address = DB::table('wallet')->where('owner_id', 0)->take(1)->pluck('address');
		DB::table('wallet')->where('address', $address)->update(array(
		   'owner_id'=>$recordId
		));
		
		$t = json_encode( array('umail'=>$umail, 'token'=>$token, 'id'=>$id) );
		$message = Crypt::encrypt($t);

        return $this->sendValidationEmail($umail, $validationToken);
	}
	

	function resetPassword($request){
		
		$umail = $request->umail;
		$id = DB::table('member')->where('email', $umail)->pluck('id');
		
		if(count($id) == 0){
			//there are no members with that email
			return json_encode( array('status'=>'0', 'message'=>'There is no user with that email address') );
		}
		
		$newPass = $this->generatePassword(8);	//password never actually gets used, only used to create a token.
		$validationToken = Crypt::encrypt($umail . "|" . $newPass . "|" . $id[0]);
		
		//save the token in the validation table
		DB::table("validation")->insert( ['owner_id'=>$id[0], 'hash'=>$validationToken]);
		
		$message = "Click on the following link to reset your password." .
		           "https://modobot.com/resetaccountpass?token=" . $validationToken;
				   
	     $this->sendEmail($umail, $message);
		
	}
	
	function resendValidation($request){
		
		//$testToken = $this->eCrypt('admin@modobot.com' . "|" . "003780ea2f2dc2b1614fd6138796137cae8d42f98959ec2afb6d84083a2da79c" . "|" . 98);
		
		//$testToken = urlencode ($testToken);
		
		//LOG::info($testToken);
		//return;
		
		//TODO:: Send out an email with the proper validation
		$umail = $request->umail;
		$id = DB::table('member')->where('email', $umail)->pluck('id');		
		$validationToken = DB::table('validation')->where('owner_id', $id)->pluck('hash');
		
		return $this->sendValidationEmail( $umail, $validationToken[0] );
	}
	
	function generatePassword($len)
	{
		$result = "";
		$chars = "abcdefghijklmnopqrstuvwxyz@#%^_?!-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$charArray = str_split($chars);
		
		for($i = 0; $i < $len; $i++){
			$randItem = array_rand($charArray);
			$result .= "".$charArray[$randItem];
		}
		return $result;	
	}
	
	function sendValidationEmail( $umail, $validationToken ){
		
		//$s = print_r($validationToken, true);
		//LOG::info($s);
		
		LOG::info("umail is $umail");
		LOG::info("validation token is $validationToken[0]");
		
		$message = "Click on the following link to validate your email address and activate your bot." .
		           "https://modobot.com/validateaccount?token=" . $validationToken[0];
				   
	     $this->sendEmail($umail, $message);
		 
		 return json_encode(  array( 'status'=>1, 'message'=>'A validation email has been sent to ' . $umail ) );
		
	}
	
	function sendEmail($email, $message){
		
		LOG::info("Sending email\n $message");
	}
	
	function validateAccount($request){

		$token = $this->dCrypt($request->token);
		$tuples = explode("|", $token);

		$umail = $tuples[0];
		$token = $tuples[1];
		$id = $tuples[2];
		
		//see if there is a user with umail and id.
	    $result = DB::table('member')->where( ['email'=> $umail, 'id'=>$id, 'token'=>$token] )->get();
		
		//see if the account has already been activated
		if($result[0]->activated == 1){
			return json_encode( array('status'=> 0, 'message'=>'This account has already been activated. Please log in.') );
		}
		
		if( count($result) > 0){
			//This is a valid result, so set the bot as active.
			$nResult = DB::table('member')->where( 'id',$id)->update(["activated"=> 1]);
			
			if($nResult == 1){
				return json_encode( array('status'=> 1, 'message'=>'Thank you! Your account has been activated, and your ModoBot is being prepared.') );
			}else{
				return json_encode( array('status'=> 0, 'message'=>'Ooops! We are unable to activate your account at this time. Please try again later, or contact support@modobot.com.') );
			}
		}

	}

	function resendAccountPass($request){
		
		$token = $this->dCrypt($request->token);
		$tuples = explode("|", $token);

		$umail = $tuples[0];
		$token = $tuples[1];
		$id = $tuples[2];
		
		//does the user exist?
		$result = DB::table('member')->where( ['email'=> $umail, 'id'=>$id] )->get();
		
		if( count($result[0]) > 0){
			//send to password reset screen
			//TODO: add a password reset view
		}else{
			return json_encode( array('status'=> 0, 'message'=>'The token is invalid. Please contact support@modobot.com for assistance.') );
		}
		
	}

}
