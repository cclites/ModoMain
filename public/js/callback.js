var ca = {
	
	loginSuccess: function(data){
		
		//No bot for that member
		if(data.bot == 0){
			alert("Unable to find a user with those credentials.");
		}else{
			model.token = data.token;
			model.session = data.session;
			
			//remove all of the splash screen stuff.
			$(".splash, .form, #newAccount").hide();
			
			//console.log( $(".logo_wrap").css("left") );
			var xPos = $(".logo_wrap").css("left");
			
			$(".logo_wrap").css( 'right', "40" );
			
			//TODO: show waiting modal
			
			//Get the bot
			mo.getBotState();
		}
	},
	
	loginFailure: function(xhr, type, exception){
		
	},
	
	getBotStateSuccess: function(data){
		
		if(data.bot == 0){
			alert("Unable to retrieve bot");
		}else{
			
			model.id = data.bot[0].id;
			model.owner_id = data.bot[0].owner_id;
			
			ko_models.bot = ko.mapping.fromJS(data);  //save model
				
			mo.getTicker();  //get the ticker
			
			setTimeout(function(){
				mo.getBotHistory();  //get the history
			}, 200);
			
		}
		
	},
	
	getBotStateFailure: function(xhr, type, exception){
		alert("getBotStateFailure");
	},
	
	getTickerSuccess: function(data){
		ko_models.ticker = ko.mapping.fromJS(data);
	},
	getTickerFailure: function(xhr, type, exception){},
	
	getBotHistorySuccess: function(data){
		ko_models.history = ko.mapping.fromJS(data);
		view.buildBotView();
	},
	
	getBotHistoryFailure: function(xhr, type, exception){},
	
};
