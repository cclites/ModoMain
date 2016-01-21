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
			
			
			//TODO: show waiting modal
			
			//Get the bot
			mo.getBotState();
		}
	},
	
	loginFailure: function(xhr, type, exception){},
	
	getBotStateSuccess: function(data){
		
		if(data.bot == 0){
			alert("Unable to retrieve bot");
		}else{
			
			model.id = data.bot[0].id;
			model.owner_id = data.bot[0].owner_id;
			
			//ko_models.bot = ko.mapping.fromJS(data);  //save model
			
			ko_models.bot = data;
				
			mo.getTicker();  //get the ticker
			
			setTimeout(function(){
				mo.getBotHistory();  //get the history
			}, 200);
			
		}
		
	},
	
	getBotStateFailure: function(xhr, type, exception){},
	
	getTickerSuccess: function(data){
		//ko_models.ticker = ko.mapping.fromJS(data);
		ko_models.ticker = data;
	},
	
	getTickerFailure: function(xhr, type, exception){},
	
	getHistorySuccess: function(data){
		
		//ko_models.history = ko.mapping.fromJS(data);
		ko_models.history = data;
		
		view.buildBotView();
	},
	
	getHistoryFailure: function(xhr, type, exception){},
	
	updateConfigsSuccess: function(data){
		console.log(data);
	},
	
	updateConfigsFailure: function (xhr, type, exception){},
	
	resetBalanceSuccess: function(data){
		
		//refresh bot
		mo.getBotState();
	},
	
	resetBalanceFailure: function(xhr, type, exception){},
	
	resetHistorySuccess: function(data){
		console.log("SUCCESS" + data);
		mo.getBotState();
	},
	
	
	resetHistoryFailure: function(xsr, type, exception){
		console.log(xsr);
		mo.getBotState();
	},
	
	getTransactionsSuccess: function(data){
		//console.log(data);
		
		var transactionView = tem.buildTransactionView(data);
		
		//throw it into a dialog and display
		$("#modals").html(transactionView).dialog(
			{
				modal: true,
				width: 800,
				height: 400,
				dialogClass: 'modalDialog',
				title: "Transactions"
			}
		);
		
		$(".ui-dialog-titlebar-close").html("X");
		
		//console.log(transactionView);
	},
	
	getTransactionsFailure: function(xsr, type, exception){
		
	},
	
	updateLoginSuccess: function(data){
		
		console.log(data);
	},
	
	updateLoginfailure: function(xsr, type, exception){},
	
	updateEmailSuccess: function (data){
		console.log(data);
	},
	
	updateEmailFailure: function(xsr, type, exception){},
	
	updateBsCongigsSuccess: function(data){
		console.log(data);
	},
	
	updateBsCongigsFailure: function(xsr, type, exception){},
	
	activateAccountSuccess: function(data){
		console.log(data);
	},
	
	activateAccountFailure: function(xsr, type, exception){},
};
