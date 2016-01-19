var view = {
	
	buildBotView: function(){
		
		//add the logout and account menu items
		view.addAuthMenuItems();
		
		$("#actionButtonContainer").html( buildActionView() );
		$("#tickerContainer").html( buildTickerView() );
		$("#ledgerContainer").html( buildLedgerView() );
		
		
		if(!mo.dirtyFlag){
			$("#configsContainer").html( buildConfigView() );
		}
		
		$("#historyContainer").html( buildHistoryView() );
		$("#statusLogContainer").html( statusLogView() ).show();
		
		mo.setUpdateTimers();
		
		//this listener sets a flag so that configs are not overwritten when 
		//the page refreshes.
		li.initDirtyFlag();
	},
	
	addAuthMenuItems: function(){
		
	    $("#bannerLeft").html('<div id="logOut" onclick="li.logOut();">&#8901;&nbsp;Log Out</div>');
	    $("#bannerRight").html('<div id="account" onclick="li.updateAccount()">&#8901;&nbsp;Account</div>');
	},
	
};
