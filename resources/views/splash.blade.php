<article class="splash">
	
	<div class="splashContent">
		Modobot is an automated trading platform for Bitcoins. It is easy to understand and simple to operate.
	</div>
	
	<div class="badgeContent">
		<img src="images/priceBoard.png">
        <img src="images/freeBoard.png">
	</div>
	
	


	<div class="splashContent">
		Select 'New Accounts' in the menu bar to build your own free automated trading bot.
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