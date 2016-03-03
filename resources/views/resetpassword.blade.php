<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MoDoBot</title>

		<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
		<link href="{{ asset('css/site.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/resetpassword.css') }}" rel="stylesheet" type="text/css" >
		<link href='https://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Allura' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Muli:400,400italic,300italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Delius|Quintessential' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	</head>
	<body>
		<span class="logo_wrap">
			<a href="http://modobot.com/ModoMain/public/"><img class="bannerLogo" src="images/ModoBotcom_x_200.png" alt="modo dot com logo" /></a>
		</span>
		<div id="banner_background"></div>
		<div class="banner"></div>
		<br>
		
		<div id="passResetForm">
			<article class="passResetArticle">
			<div class="passreset">
			<h1>Reset Password</h1>
			<ol>
				<li>
					<span >Enter Username</span>
		    		<input id="passResetUsername" val="">
				</li>
		
				<li>
					<span class="resetPass">Create a password</span></span>
		    		<input type="password" id="resetPass1" val="">
				</li>
		
				<li>
					<span class="resetPass">Retype Password</span>
		    		<input type="password" id="resetPass2" val="">
				</li>
			</ol>
			<br>
			<button onclick="li.resetPassUpdate()" class="action">Reset Password</button>

		</div>
		</article>
	</div>


		<div id="modals"></div>
		<div id="alertModals"></div>

		
				<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.4.1/knockout.mapping.min.js"></script>
		
		<script type="text/javascript" src="{{ asset('js/model.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/modobot.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/listener.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/callback.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/view.js') }}"></script>

	</body>
	
</html>

