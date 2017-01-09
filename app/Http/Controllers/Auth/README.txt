The app uses a home-brewed CSRF protection scheme that is not obvious.

For security purposes, when a user registers, a special token is generated based on the user name, the pasword, and the seed. This value is stored in the database, eliminating the need to store a password, plain-text or otherwise.

When a user logs in, the user name and password is tokenized, and the database checked for a match. If there is a match, the user is registered, and a new 'session' token is created. The session token is made up of the user_id, the user_token, and a timestamp, which is then encrypted. When the page loads, the session and the token are both stored in a JavaScript model.

Whenever the page makes a request, the back-end uses code like this to authenticate the session -

$token = $request -> token;
$session = $request -> session;

//Session::get('authenticated') is a t/f flag set when authenticated

if( Session::get('session') == $session &&
		    Session::get('token') == $token &&
			Session::get('authenticated') ){
				
			//The token is passed back as owner_id
			$id = Crypt::decrypt($request->owner_id);
			
			//decrypt the session token to get the bot owner id (member.id in the database)
			$owner_id= CRYPT::decrypt($request->owner_id);
			
			//Use the owner id and hte token to grab the correct member record.
			$member = DB::table('member')->where('token', $request -> token )->where('id', $id)->get();
			
			if($member == 0){
				
				return json_encode(array('status'=>$result, 'message'=>'User does not exist.'));
				
			}else if  ...
			


An attacker would need to know the salt used to encode the token, and the time used to seed the session, in order to have any hope of generating valid tokens.