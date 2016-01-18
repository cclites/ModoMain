<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MoDo V1</title>

		<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
		<link href="{{ asset('css/site.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/splash.css') }}" rel="stylesheet" type="text/css" >
		<link href='https://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Allura' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		
		

	</head>
	<body>
		<span class="logo_wrap">
			<img class="bannerLogo" src="images/ModoBotcom_x_200.png" alt="modo dot com logo" />
		</span>
		

		<div id="banner_background"></div>
		<div class="banner">
			<div class="bannerContent">
				<div id="bannerLeft">
					<div class="form">
						<input id="banner_uname" type="text" required="required" autofocus="" placeholder="Username" data-bind="value: uName" value="ModoBot">
						<input id="banner_upass" type="password" required="required" placeholder="Password" data-bind="value: uPass" value="modobot_demo">
						<button id="logIn" type="submit">
							⋅ Log In
						</button>
					</div>
				</div>
				<div id="bannerCenter"></div>
				<div id="bannerRight">
					<span id="newAccount" onclick="newAccount()">⋅ New Account</span>
				</div>
			</div>
		</div>
		<br>
		<div id="frame">
			<div id="statusLogContainer"></div>
			<div id="botContainer">

				@include('splash')

				<div id="tickerContainer"></div>
				<br>
				<div id="ledgerContainer"></div>
				<div id="configsContainer"></div>
				<div id="calculatorContainer"></div>
				<div id="historyContainer"></div>
				<div id="footerContainer"></div>
			</div>

			<footer>
				All rights reserved - modobot & modobot.com (2013-<?php echo date('Y'); ?>)
				<br/>
				ModoBot logo is the property of modobot.com, and may not be reproduced without permission.
				<br/>
			</footer>

		</div>

		<!--div id="footer_background"></div-->

		<div id="modals"></div>
		<div id="waitModal"></div>
		<div class="contact glyphicon-envelope btn-lg" onclick="contactDisplay()"></div>
		<br>

		<script>
			var model;
		</script>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.4.1/knockout.mapping.min.js"></script>
		
		<script type="text/javascript" src="{{ asset('js/model.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/modobot.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/listener.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/callback.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/templates.js') }}"></script>
		

		<script>
			/*
			 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			 ga('create', 'UA-47845671-1', 'modobot.com');
			 ga('send', 'pageview');
			 */

		</script>
	</body>

</html>

