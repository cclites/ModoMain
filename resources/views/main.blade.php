<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MoDoBot</title>

		<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
		<link href="{{ asset('css/site.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/splash.css') }}" rel="stylesheet" type="text/css" >
		<link href='https://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Allura' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Muli:400,400italic,300italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Delius|Quintessential' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		
		

	</head>
	<body>
		<span class="socMediaButtons">
			<a href="https://www.facebook.com/ModoAdmin" target="_blank"><i class="fa fa-facebook-square fa-3x"></i></a>
		</span>
		<span class="logo_wrap">
			<img class="bannerLogo" src="images/ModoBotcom_x_200.png" alt="modo dot com logo" />
		</span>
		

		<div id="banner_background"></div>
		<div class="banner">
			<i id="mail" class="fa fa-envelope-o fa-4x" onclick="li.contact()"></i>
			<div class="bannerContent">
				<div id="bannerLeft">
					<div class="form">
						<input id="banner_uname" type="text" required="required" autofocus="" placeholder="Username" value="">
						<input id="banner_upass" type="password" required="required" placeholder="Password" value="">
						<button id="logIn" type="submit">
							Log In
						</button>
					</div>
				</div>
				<div id="bannerCenter"></div>
				<div id="bannerRight">
					<span id="newAccount" onclick="li.newAccount()">New Account</span>
				</div>
			</div>
		</div>
		<br>
		
		@include('partials/handles')
		
		<div class='statusIndicator'>
		    <span>Configuration Saved.<i class="fa fa-heart saveStatus"></i></span>	
		</div>
		
		<div id="frame">
			
			@include('splash')
			
			<div>
				<div id="statusLogContainer"></div>
				<div>
					<div id="tickerContainer"></div>
					<div id="ledgerContainer"></div>
				    <div id="configsContainer"></div>
				</div>
				
				<div style="float: left;">
					<div id="historyContainer"></div>
				    <div id="actionButtonContainer"></div>
				</div>
				
				
				
			</div>
			<br><br><br>
			<footer>
				<div>All rights reserved - modobot & modobot.com (2013-<?php echo date('Y'); ?>)</div>
				<div>ModoBot logo is the property of modobot.com, and may not be reproduced without permission.</div>
			</footer>

		</div>
		
		@include('partials/bothelp')
		@include('partials/accounthelp')
		@include('partials/reviews')
		@include('partials/privacypolicy')

		<div id="modals"></div>
		<div id="alertModals"></div>
		<div id="messageModals"></div>
		<div id="waitModal">
			<div class='waitContainer'>
				<div class='modalMessage'></div>
				<i class="fa fa-cog fa-4x fa-refresh fa-spin"></i>
			</div>
			
		</div>
		<div class="contact glyphicon-envelope btn-lg" onclick="contactDisplay()"></div>
		<br>

		<script>
			var model;
		</script>
		
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
		<!--script type="text/javascript" src="{{ asset('js/calculator.js') }}"></script-->
		
		<script type="text/javascript" src="{{ asset('js/templates.js') }}"></script>
		
		<script type="text/javascript" src="{{ asset('js/ViewModels/Account.js') }}"></script>
		<!--script type="text/javascript" src="{{ asset('js/ViewModels/Banner.js') }}"></script-->
		<script type="text/javascript" src="{{ asset('js/ViewModels/Calculator.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/Configs.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/Contact.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/Action.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/History.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/Ledger.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/StatusLog.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/Ticker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ViewModels/Transact.js') }}"></script>


		<script>
		
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-47845671-1', 'modobot.com');
			ga('send', 'pageview');
			
		</script>
	</body>
	
</html>

