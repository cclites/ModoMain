var li = {
	
	initLogin: function(){
		
		$("#logIn").click(function(){
			
			mo.submitLogIn();
					
		});
				
	},
	
	updateConfigs: function(){
		
		var  url = "update",
	         data = {
		     	session: model.session, 
		     	token: model.token, 
		     	id: model.id, 
		     	owner_id: model.owner_id,
		     	base: document.getElementById("base").value,
		        is_active : document.getElementById("isActive").checked, 
				testing_mode : document.getElementById("isTesting").checked, 
				buying : document.getElementById("isBuying").checked, 
				selling : document.getElementById("isSelling").checked, 
				increase : document.getElementById("increase").value, 
				sellLimitBtc : document.getElementById("sellLimitBtc").value, 
				decrease : document.getElementById("decrease").value, 
				buyLimitBtc : document.getElementById("buyLimitBtc").value,
				fixed_sell : document.getElementById("fixed_sell").checked,
				fixed_buy : document.getElementById("fixed_buy").checked,
				fixed_sell_amount : document.getElementById("fixed_sell_amount").value,
				fixed_buy_amount : document.getElementById("fixed_buy_amount").value
			},
	        request = new mo.requestObject(url, "POST", ca.updateConfigsSuccess, ca.updateConfigsFailure, data);
	
		mo.dirtyFlag = false;    
		mo.asynch(request);
		
	},
	
	resetBalance: function(){
		
		var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "resetbalance",
		    request = new mo.requestObject(url, "POST", ca.resetBalanceSuccess, ca.resetBalanceFailure, data);
		    
		mo.asynch(request);
		
	},
	
	resetHistory: function(){
		var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "resethistory",
		    request = new mo.requestObject(url, "POST", ca.resetHistorySuccess, ca.resetHistoryFailure, data);
		    
		mo.asynch(request);
	},
	
	getTransactions: function(){},
	
	logOut: function(){
		//TODO: Put into .env
		location.href = "//localhost/ModoMain/public/";
	},
	
	updateAccount: function(){},
	
	initDirtyFlag: function(){
		
		$(".configSummary#configSummary input").keyup(function(){
			mo.dirtyFlag = true;
		});
	}
	
};
