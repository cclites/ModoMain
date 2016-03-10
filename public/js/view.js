var view = {
	
	buildBotView: function(){
		
		//remove all of the splash screen stuff.
		$(".splash, .form, #newAccount").hide();
		$(".statusIndicator").show();
		
		//add the logout and account menu items
		view.addAuthMenuItems();
		
		$("#actionButtonContainer").html( buildActionView() );
		$("#tickerContainer").html( buildTickerView() );
		$("#ledgerContainer").html( buildLedgerView() );
		
		
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
	    $("#bannerRight").html('<div id="account" onclick="li.updateAccount()">Account</div> <div id="adminPort"></div>');
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
