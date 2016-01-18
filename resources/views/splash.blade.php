<article class="splash">

	<div>
		Modobot is an automated trading platform for Bitcoins. It is easy to understand and simple to operate.
	</div>

</article>

<article class="splash">

	<div id="box1" class="brighten">

		<div id="accent1">
			<div class="quarter-circle-left"></div>
			<div class="marquee_band"></div>
			<div class="quarter-circle-right"></div>
		</div>

		<div id="accent2">
			<div class="quarter-circle-left"></div>
			<div class="marquee_band"></div>
			<div class="quarter-circle-right"></div>
		</div>

		<div id="accent3">
			<div class="quarter-circle-left"></div>
			<div class="marquee_band"></div>
			<div class="quarter-circle-right"></div>
		</div>

		<div id="neon" class="label flickerOff">
			Signups are open!
		</div>

	</div>

	<div id="box2">
		<div id="box3"></div>
	</div>
	
	
	<br />
	<div class="splashContent">
		Click on 'New Accounts' in the upper right hand corner to register for a free automated trading bot.
	</div>

</article>

<script>
	function flicker(flag) {

		if (flag == "on") {

			$("#neon").removeClass("flickerOn");
			$("#box1").removeClass("brighten").addClass("dim");
			$("#neon").addClass("flickerOff");

			var rand = Math.random() * (400 - 50) + 50;
			setTimeout(function() {
				flicker("off");
			}, rand);
		} else {

			$("#neon").removeClass("flickerOff");
			$("#box1").removeClass("dim").addClass("brighten");
			$("#neon").addClass("flickerOn");

			var rand = Math.random() * (6500 - 10) + 10;
			setTimeout(function() {
				flicker("on");
			}, rand);
		}
	}



	var rand = Math.random() * (400 - 40) + 10
	setTimeout(function() {
		flicker("on");
	}, rand);

</script>