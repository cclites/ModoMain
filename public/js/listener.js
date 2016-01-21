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
	
	getTransactions: function(){
		var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "transactions",
		    request = new mo.requestObject(url, "POST", ca.getTransactionsSuccess, ca.getTransactionsFailure, data);
		    
		mo.asynch(request);
		
	},
	
	logOut: function(){
		//TODO: Put into .env
		location.href = "//localhost/ModoMain/public/";
	},
	
	updateAccount: function(){
		
		console.log("Updating account");
		
		var accountView = tem.buildAccountView();
		
		//throw it into a dialog and display
		$("#modals").html(accountView).dialog(
			{
				modal: true,
				width: 800,
				height: 400,
				dialogClass: 'modalDialog',
				title: "Account"
			}
		);
		
		$(".ui-dialog-titlebar-close").html("X");
	},
	
	initDirtyFlag: function(){
		
		$(".configSummary#configSummary input").keyup(function(){
			mo.dirtyFlag = true;
		});
	},
	
	saveNewPass: function(){
		
		var pass1 = $("#newPass1").val(),
		    pass2 = $("#newPass1").val(),
		    data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id, pass1: pass1, pass2: pass2},
		    url = "updatelogin",
		    request = new mo.requestObject(url, "POST", ca.updateLoginSuccess, ca.updateLoginFailure, data);
		    
		mo.asynch(request);
		
	},
	
	showAccountConfig: function(section){
		
		$(".accountAction").hide();
		$(section).show();
	},
	
	saveNewEmail: function(){
		
		var newMail = $("#newMail").val(),
		    url = 'updatemail',
		    data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id, newMail: newMail},
		    request = new mo.requestObject(url, "POST", ca.updateEmailSuccess, ca.updateEmailFailure, data);
		    
		mo.asynch(request);
	},
	
	updateBitstampConfigs: function(){
		var utoken = $("#key").val(),
		    usecret = $("#secret").val(),
		    uid = $("#acctId").val(),
		    url = 'updatebsconfigs',
		    data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id, newMail: newMail, utoken:utoken, usecret: usecret, id: uid},
		    request = new mo.requestObject(url, "POST", ca.updateBsCongigsSuccess, ca.updateeBsCongigsFailure, data);
		    
		mo.asynch(request);
	},
	
	activateAccount: function(){
		
		var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "activateaccount",
		    request = new mo.requestObject(url, "POST", ca.activateAccountSuccess, ca.activeAccountFailure, data);
		    
		mo.asynch(request);
		
	},
	
};
