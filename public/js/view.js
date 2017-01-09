var view = {
	
	//Main functio nthat builds the bot view. Gets called each time
	buildBotView: function(){
		
		//remove all of the splash screen stuff.
		$(".splash, .form, #newAccount").hide();
		$(".statusIndicator").show();
		
		//add the logout and account menu items
		view.addAuthMenuItems();
		
		//Build some parts
		$("#actionButtonContainer").html( buildActionView() );
		$("#tickerContainer").html( buildTickerView() );
		$("#ledgerContainer").html( buildLedgerView() );
		
		//We do not want to overwrite the configs if we have config
		//data waiting to be written to the server.
		if(!mo.dirtyFlag){
			$("#configsContainer").html( buildConfigView() );
		}
		
		$("#historyContainer").html( buildHistoryView() );
		
		if( $("#statusLogContainer").css("display") === 'block' ) {
			//just update. Eventually we will check for messages from server
			//TODO: implement messaging poll.
		}else{
			$("#statusLogContainer").html( statusLogView() ).show();
		}

		
		mo.setUpdateTimers();
		
		//this listener sets a flag so that configs are not overwritten when 
		//the page refreshes.
		li.initDirtyFlag();
		
		mo.updateMargins();

	},
	
	addAuthMenuItems: function(){
		
	    $("#bannerLeft").html('<div id="logOut" onclick="li.logOut();">Log Out</div>');
	    $("#bannerRight").html('<div id="account" onclick="li.updateAccount()">Account</div>');
	    
	    if(ko_models.bot.ring[0]==0){
	    	var str = "<div id='adminView' onclick='li.getEmails()'>Admin</div>";
			$('#bannerRight').append(str);
	    }
	},

	buildNewAccountView: function(){
		
		 var newAccountView = tem.buildNewAccountView();
		 
		 //throw it into a dialog and display
		$("#modals").html(newAccountView).dialog(
			{
				modal: true,
				width: 800,
				height: 550,
				dialogClass: 'modalDialog',
				title: "New Account"
			}
		);
		
		$(".ui-dialog-titlebar-close").html("X");
	},
	
};
