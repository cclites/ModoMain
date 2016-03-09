var ca = {
	
	loginSuccess: function(data){
		
		//No bot for that member
		if(data.status == 0){
			mo.log("Unable to find a user with those credentials.");
			li.alertModal("Unable to find a user with those credentials.");
			$("#waitModal").hide("fade");  //Just in case modal is open
		}else{
			
			console.log("Log in succeeded");
			
			model.token = data.token;
			model.session = data.session;
			
			$(".modalMessage").html("Loading content"); //show modal
			$("#waitModal").toggle("fade");

			//Get the bot
			mo.getBotState();
			mo.pollDirty();   //poll the dirty flag.
			mo.log("Ready....");
			
		}
		
		
	},
	
	loginFailure: function(xhr, type, exception){},
	
	getBotStateSuccess: function(data){
		
		if(data.bot == 0){
			mo.log("Unable to retrieve bot"); 
		}else{
			
			model.id = data.bot[0].id;
			model.owner_id = data.bot[0].owner_id;

			ko_models.bot = data;
				
			mo.getTicker();  //get the ticker
			
			setTimeout(function(){
				mo.getBotHistory();  //get the history
			}, 200);
			
			setTimeout(function(){
				mo.getMessages();//get the messages
			}, 700);
			
		}
		
	},
	
	getBotStateFailure: function(xhr, type, exception){},
	
	getTickerSuccess: function(data){
		//ko_models.ticker = ko.mapping.fromJS(data);
		ko_models.ticker = data;
	},
	
	getTickerFailure: function(xhr, type, exception){},
	
	getMessagesSuccess: function(data){
		for(var i=0;i<data.message.length;i++){
			mo.log("---"+data.message[i]+"---");//loop to display all messages
		}
	},
	
	getMessagesFailure: function(xhr, type, exception){},
	
	getHistorySuccess: function(data){
		
		//ko_models.history = ko.mapping.fromJS(data);
		ko_models.history = data;
		view.buildBotView();
		
		mo.log("Updated.");
		
		if( $("#waitModal").css("display") == "block"){
			
			setTimeout(function(){ //hide
				$("#waitModal").toggle("fade");
			    //$(".modalMessage").html("");
			    
			}, 1000);
			
		}
		
	},
	
	getHistoryFailure: function(xhr, type, exception){},
	
	updateConfigsSuccess: function(data){
		
		mo.log("Configuration has been updated.");
		$(".statusIndicator").html(tem.showStatusAsSaved);		
	},
	
	updateConfigsFailure: function (xhr, type, exception){
		
		console.log(xhr);
		console.log(type);
		console.log(exception);
		
	},
	
	resetBalanceSuccess: function(data){
		mo.log("Balance has been reset");
		mo.getBotState();
	},
	
	resetBalanceFailure: function(xhr, type, exception){},
	
	resetHistorySuccess: function(data){
		console.log("SUCCESS" + data);
		mo.log("History has been reset");
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
			
		if(data.status == 1){
			
			
			//mo.log("Your password has been updated.");
			li.alertModal("Your password has been updated. You will be logged out now.");
			//model.token = data.token;
			//model.session = data.session;
			setTimeout(function(){
				
				li.logOut();
				
			}, 800);
			
		}else{
			mo.log("Unable to update password at this time. Please try later.");
			alert("Unable to update password at this time. Please try later.");
		}
		
		$(".ui-dialog-titlebar-close").trigger("click");
	},
	
	updateLoginfailure: function(xsr, type, exception){},
	
	updateEmailSuccess: function (data){
		
		if(data.status == 1){
			mo.log("Your email address has been updated.");
			li.alertModal("Your email address has been updated.");
		}else{
			mo.log("Your email address could not be validated at this time. Please try later.");
			li.alertModal("Your email address could not be validated at this time. Please try later.");
		}
		
		$(".ui-dialog-titlebar-close").trigger("click");
		
	},
	
	updateEmailFailure: function(xsr, type, exception){},
	
	updateBsCongigsSuccess: function(data){
		
		if(data.status == 1){
			mo.log("Your Bitstamp info has been updated.");
			li.alertModal("Your Bitstamp info has been updated.");
			
		}else{
			mo.log("Your Bitstamp info could not be updated at this time. Please try later.");
			li.alertModal("Your Bitstamp info could not be updated at this time. Please try later.");
		}
		
		$(".ui-dialog-titlebar-close").trigger("click");
	},
	
	updateBsCongigsFailure: function(xsr, type, exception){},
	
	activateAccountSuccess: function(data){

		if(data.status == 1){
			mo.log("Notification to activate account has been sent.");
			li.alertModal("Notification to activate account has been sent.");
		}else{
			mo.log("Unable to activate account at this time.");
			li.alertModal("Unable to activate account at this time.");
		}
		
		$(".ui-dialog-titlebar-close").trigger("click");
	},
	
	activateAccountFailure: function(xsr, type, exception){},
	
	addNewMemberSuccess:function(data){
		
		if(data.status == 1){
		  li.alertModal("An activation email has been sent. Modobot will only work in test mode until your email address has been validated." +
		                "Close this window, and log in now.");
		  
		  $(".modalDialog ").dialog("close");           
		  
		}else{
			li.alertModal("We are unable to create your account at this moment. Please try again.");
		}
		
		
		
		//$(".ui-dialog-titlebar-close").trigger("click");
	},
	
	addNewMemberFailure: function(xsr, type, exception){},
	
	resetPasswordSuccess: function(data){ alert();
		console.log(data);
	},
	
	resetPasswordFailure: function(xsr, type, exception){},
	
	resetPasswordViewSuccess: function(data){ 
		li.alertModal(data.message);
		console.log(data);
	},
	
	resetPasswordViewFailure: function(xsr, type, exception){},
	
	resetValidationSuccess: function(data){
		console.log(data);
	},
	
	resendValidationFailure: function(xsr, type, excpetion){},
	
	sendContactSuccess: function(data){
		
		console.log(data);
		$("#modals").dialog("close");
		
		if( data.status == 1){
			li.alertModal("A message has been sent.");
		}
	},
	
	sendContactFailure: function(xsr, type, exception ){
		
		li.alertModal("There was an error. Please try again later.");
	},
	
};
