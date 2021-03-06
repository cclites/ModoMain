<?php

/*
 * Most of the following code couold be re-written using Laravel's built
 * in authentication. This was ported directly over from vanilla php 
 */

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
		
		//LOG::info($this->uPass);
		
		//Server side sanity check
		if (!$this -> uName || !$this -> uPass)
			return json_encode( array('uname'=> $this -> uName, 'upass'=>$this -> uPass) );

		$token = $this -> createToken();
		$this -> token = $token;
		

		$member = new Member();
		
		$record = $member -> getMemberInfo($token);
	

		if ( gettype($record) === "object" ) {

			$this -> message = "Credentials Validated.";
			$this -> registered = true;

			//anti-session hijacking.
            Session::put('authenticated', true);
			Session::put('token', $token);

			$this->userId = $record->id;
			$toEncrypt = $record->id . "|" . $this -> token . "|" . time();
			$encryptedSession = $this->eCrypt($toEncrypt );
			$this->session = $encryptedSession;
			
			$encryptedSession = htmlentities($encryptedSession);
			$this->token = htmlentities($this->token);
			
			//special token just for this session, saved to session
			Session::put('session', $encryptedSession);
			
			//update the database
			$d = date('Y-m-d G:i:s');
			DB::table("member")->where('id',$record->id)->update(['last_viewed'=>$d]);
			
            //also return the special token to the client. That token will be returned by the user
            //with any request so that it can be compared to the token stored in the session. 
			return json_encode( array('token'=>$this->token, 'session'=>Session::get('session') ) );
			
		} else {
			//writeLog("Member does not exist", AUTHENTICATE);
			return json_encode( array('status'=>0) );
		}
	}

    /*
	 * createToken creates a hash using the users user name, password, and seed.
	 * No passwords are saved in the database, but the token is, and so can be 
	 * used as a database index.
	 * 
	 * This loops a bunch of times to make it computationally expensive to brute force
	 */
	function createToken(){
		
		$token = $this -> uName . config('core.SEED') . $this -> uPass;

		for ($i = 0; $i < 100000; $i += 1) {
			$token = hash("sha256", $token, false);
		}

		return hash("sha256", $token, false);

	}

  
	function eCrypt($toEncrypt) {	
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
		return base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash('sha256', config('core.SEED'), true), $toEncrypt, MCRYPT_MODE_CBC, $iv));
	}

	function dCrypt($toDecrypt) {
		$data = base64_decode($toDecrypt);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, hash('sha256', config('core.SEED'), true), substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv), "\0");

	}
	
	function updateLogin($request){
		
		$pass1 = $request -> pass1;
		$pass2 = $request-> pass2;
		
		$token = $request -> token;
		$session = $request -> session;
		

		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
			$id = Crypt::decrypt($request->owner_id);
			
			$owner_id= CRYPT::decrypt($request->owner_id);
			
			$member = DB::table('member')->where('token', $request -> token )->where('id', $id)->get();
			
			if($member == 0){
				
				return json_encode(array('status'=>$result, 'message'=>'Unable to change log-on credentials at the moment.'));
				
			}else if( count($member) == 1 ){
				
				$this->uPass = $pass1;
				$this->uName = $member[0]->display_name;
				
				$newToken = $this->createToken();   
				                                   
				//need to recreate session
				$this->userId = $member[0]->id;
				
				//This is the sneaky part. To prevent session hijacking, and encrypted key is generated
				//containing member id, token, and timestamp for noise. This session token gets
				//sent with each reauest, and is then decrypted to make sure the token encrypted in the
				//session matches the actual user token that also gets sent along with each request.
				$toEncrypt = $member[0]->id . "|" . $newToken . "|" . time();
				
				$encryptedSession = $this->eCrypt($toEncrypt );
				$this->session = $encryptedSession;                                   
				                                   
				//now update the database
				$result = DB::table('member')->where('id', $owner_id)
				          ->update(array(
		                        'token' => $newToken,
		                        'session' => $this->session
							));
							
				//return json_encode( array('status'=>$result) );
				if($result == 0){
					
					return json_encode(array('status'=>0, 'message'=>'Unable to change log-on credentials at the moment.'));
					
				}else{
					return json_encode(array('status'=>1, 'token'=> $newToken ));
				}
	
			}
			
			$this->uName = $result[0]->display_name;
			$this->uPass = $pass1;
				
		}

	}
	
	function updateEmail($request){
		
		$token = $request -> token;
		$session = $request -> session;
		$newMail = $request->newMail;
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
				$owner_id= CRYPT::decrypt($request->owner_id);
				
				//save new email
				if( count($owner_id) > 0 ){
					
					//now update the database
					$result = DB::table('member')->where('id', $owner_id)
					          ->update(array(
			                        'email' => $newMail
								));
								
					return json_encode( array('status'=>$result) );
					
				}
		}	
	}
	
	//bs = BitStamp
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
					//$newToken = Crypt::encrypt( $token );
					$newToken = $this->eCrypt($token);
					
					//now update the database
					$result = DB::table('user')->where('owner_id', $id)
					          ->update(array(
			                        'api_key' => $newToken
								));
								
					return json_encode( array('status'=>$result) );
					
				}else{
					
					$token = json_encode( array( 'uid'=>$uId , 'usecret'=>$uSecret, 'utoken'=>$uToken) );
					$newToken = $this->eCrypt($token);
					
					LOG::info("New Token:\n$newToken");
					
					//add user to the database
					$result = DB::table('user')->insert(
			                        ['api_key' => $newToken,
			                        'owner_id'=> $id]
								);
								
					return json_encode( array('status'=>$result) );
				}
			}
		
	}
			
	
	function activateAccount($request){
		
		//Don't think this is used any more.
        Log::info("activateAccount should no longer be used.");
        return;
		
		$token = $request -> token;
		$session = $request -> session;
		
		//LOG::info("Activating account");
		
		if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
				//LOG::info("Valid account...");
				
				$id = Crypt::decrypt($request->owner_id);
				
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
					return json_encode( array('status'=>$result) );
				}
		}
	}
	
	
	function addNewUser($request){
		
		$umail = $request->umail;
		
		//validate email
		if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
           return json_encode( array('status'=>0, 'message'=>"Please enter a valid email address.") );
        }
		
		
		$this -> uName = $request->uname;
		$this -> uPass = $request->upass;
		
		$token = $this -> createToken();
		$this -> token = $token;
		
		if ($request->umail == "" || $request->uname == "" || $request->upass == ""){
			return json_encode(array('status'=>0, 'message'=> 'Please make sure to fill all fields') );
		}

		
		//add user to the database.
		$owner_id = DB::table('member')->insertGetId(
		    ['email' => $umail, 'token' => $token, 'display_name'=>$this -> uName]
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
		
		//add user
		DB::table('validation')->insert(
		    ['owner_id'=>$owner_id, 'hash'=>$validationToken]
		);
		
		$t = json_encode( array('umail'=>$umail, 'token'=>$token, 'id'=>$owner_id) );
		$message = Crypt::encrypt($t);

        return $this->sendValidationEmail($umail, $validationToken);
	}
	

	function resetPassword($request){
		
		$umail = $request->umail;
		$id = DB::table('member')->where('email', $umail)->pluck('id');
		//Log::info($umail);
		if(count($id) == 0){
			//there are no members with that email
			return json_encode( array('status'=>'0', 'message'=>'There is no user with that email address') );
		}
		
		$newPass = $this->generatePassword(8);	//password never actually gets used, only used to create a token.
		$validationToken = $this->eCrypt($umail . "|" . $newPass . "|" . $id[0]);
		
		//save the token in the validation table
		DB::table("validation")->insert( ['owner_id'=>$id[0], 'hash'=>$validationToken]);
		
		$message = "Click on the following link to reset your password.  " .
		           config('core.BASEPATH')."/resetaccountpass?token=" . urlencode($validationToken);
		LOG::info($message);		   
	     $this->sendEmail($umail, $message);
		
	}
	
	function resendValidation($request){
		
		//TODO:: Send out an email with the proper validation
		$umail = $request->umail;
		$id = DB::table('member')->where('email', $umail)->pluck('id');		
		$validationToken = DB::table('validation')->where('owner_id', $id)->pluck('hash');
		
		return $this->sendValidationEmail( $umail, $validationToken[0] );
	}
	
	/*
	 * Generates a temp password for user.
	 */
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
		
		LOG::info("umail is $umail");
		LOG::info("validation token is $validationToken[0]");
		
		$message = "Click on the following link to validate your email address and activate your bot. " .
		           config('core.BASEPATH')."/validateaccount?token=" . urlencode($validationToken);
				   
	     $this->sendEmail($umail, $message);
		 
		 return json_encode(  array( 'status'=>1, 'message'=>'A validation email has been sent to ' . $umail ) );
		
	}
	
	function sendEmail($email, $message){
		mail($email, 'MoDoBot', $message);
		LOG::info("Sending email\n $message");
	}
	
	function validateAccount($request){
		//LOG::info("I am here");
		$token = $this->dCrypt($request->token);//LOG::info($token);
		$tuples = explode("|", $token);
		
		//LOG::info($tuples);
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
			
			//I want to update bot.live, not member activated
			$nResult = DB::table('member')->where( 'id',$id)->update(["activated"=> 1]);
			$nResult = DB::table("bot")->where('owner_id', $id)->update(["live"=>1]);
			
			//remove entry from validation table
			DB::table("validation")->where("owner_id", $id)->delete();
			
			if($nResult == 1){
				return "<div class='thankyou'>Thank you! Your account has been activated, and your ModoBot is being prepared. <br><br> <a href='http://www.modobot.com' style='text-decoration:none'><button>Go to ModoBot.com</button></a></div>";
			}else{
				return "Ooops! We are unable to activate your account at this time. Please try again later, or contact support@modobot.com. <br><br> <button><a href='http://www.modobot.com' style='text-decoration:none'>ModoBot</a></button>";
			}
		}

	}

	function resendAccountPass($request){
		
		$token = $this->dCrypt($request->token); 
		//LOG::info($token);
		$tuples = explode("|", $token); 
		//LOG::info($tuples);
		$umail = $tuples[0];
		$token = $tuples[1];
		$id = $tuples[2];
		
		//does the user exist?
		$result = DB::table('member')->where( ['email'=> $umail, 'id'=>$id] )->get();
		
		if( count($result[0]) > 0){
			return view("resetpassword");
		}else{
			return json_encode( array('status'=> 0, 'message'=>'The token is invalid. Please contact support@modobot.com for assistance.') );
		}
		
	}
	
	function resetPassUpdate($request){ 
		$token = urldecode($request->token); 
		LOG::info($token);
		$this -> uName = $request->uname;
		$this -> uPass = $request->upass;
		//LOG::info('Pass: ' . $this->uPass);
		//LOG::info('Name: ' . $this->uName);
		$uId = DB::table('validation')->where('hash',$token)->pluck('owner_id');
		//LOG::info ($uId);
		$result = DB::table('member')->where('id', $uId)->where('display_name',$this->uName)->get();
		//LOG::info($result[0]);
		DB::table('validation')->where('hash',$token)->delete();
		
		if( count($result[0]) > 0){
			$token = $this -> createToken();
			//LOG::info($token);
			DB::table('member')->where(['id'=>$uId, 'display_name'=>$this->uName ])->update(['token'=>$token]);
			return json_encode( array('status'=> 1, 'message'=>'Your new password is updated. Click on the logo to return to the main menu.') );
		}else{
			return json_encode( array('status'=> 0, 'message'=>'The token is invalid. Please contact support@modobot.com for assistance.') );
		}
	
	}
	
	function transactionEmail($id, $type){
		$balance = DB::table('member')->where('id',$id)->pluck('balance');
		$activated = DB::table('member')->where('id',$id)->pluck('activated');
		$live = DB::table('bot')->where('owner_id',$id)->pluck('live');
		$notify = DB::table('userconfigs')->where('owner_id',$id)->where('name', 'transNotify')->pluck('param');
		if($balance[0]>0 && $activated[0]==1 && $live[0]==1 && $notify[0]=='t'){
			$message = "A " . $type . " transaction has been initiated on Modobot.";
			$email = DB::table('member')->where('id',$id)->pluck('email');
			$this->sendEmail($email[0], $message);
		}
		return;
	}


}
