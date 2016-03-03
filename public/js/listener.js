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
		location.reload();
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
			$(".statusIndicator").html(tem.showStatusAsDirty);
		}).click(function(){
			mo.dirtyFlag = true;
			$(".statusIndicator").html(tem.showStatusAsDirty);
		});
	},
	
	saveNewPass: function(){
		
		var pass1 = $("#newPass1").val(),
		    pass2 = $("#newPass1").val();
		
		 
		if( pass1 === pass2 && (pass1 != "" && pass2 != "")){  
			var url = "updatelogin",
				data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id, pass1: pass1, pass2: pass2},
				request = new mo.requestObject(url, "POST", ca.updateLoginSuccess, ca.updateLoginFailure, data);
			mo.asynch(request);
		}else if(pass1 == "" || pass2 == ""){
			li.alertModal("Please fill in both fields.");
		}else{
			li.alertModal("Passwords do not match.");
		}

	},
	
	showAccountConfig: function(section){
		
		$(".accountAction").hide();
		$(section).show();
	},
	
	saveNewEmail: function(){
		
		var newMail = $("#newMail").val(),
		    url = 'updateemail',
		    data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id, newMail: newMail},
		    request = new mo.requestObject(url, "POST", ca.updateEmailSuccess, ca.updateEmailFailure, data);
		    
		if(newMail == ""){
			li.alertModal("You must provide an email address.");
		}else{
			mo.asynch(request);
		}
		    
		
	},
	
	updateBitstampConfigs: function(){
		var utoken = $("#key").val(),
		    usecret = $("#secret").val(),
		    uid = $("#acctId").val(),
		    url = 'updatebsconfigs',
		    data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id, utoken:utoken, usecret: usecret, uid: uid},
		    request = new mo.requestObject(url, "POST", ca.updateBsCongigsSuccess, ca.updateeBsCongigsFailure, data);
		    
		if(utoken == "" || usecret == "" || uid == ""){
			li.alertModal("Please fill in all BitStamp congigs");
		}else{
			mo.asynch(request);
		}

	},
	
	activateAccount: function(){
		
		var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "activateaccount",
		    request = new mo.requestObject(url, "POST", ca.activateAccountSuccess, ca.activeAccountFailure, data);
		    
		mo.asynch(request);
		
	},
	
	newAccount: function(){
        view.buildNewAccountView();
	},
	
	addNewMemberHome: function(){
		
		var data = {
			 	umail: $("#newUserEmail").val(),
			 	uname: $("#newUserName").val(),
			 	upass: $("#newUserPass").val()
			 }, 
			 url = 'addnewuser',
			 request = new mo.requestObject(url, "POST", ca.addNewMemberSuccess, ca.activeAccountFailure, data);
			
	    if(data.email == "" || data.uname == "" || data.upass == ""){
	    	li.alertModal("Please fill in all information.");
	    }else{
	    	li.alertModal("Account is being built.");
	    	mo.asynch(request);
	    }
		 
        
	},
	
	addNewMember: function(){
		
		var data = {
			 	umail: $("._newUserEmail").val(),
			 	uname: $("._newUserName").val(),
			 	upass: $("._newUserPass").val()
			 }, 
			 url = 'addnewuser',
			 request = new mo.requestObject(url, "POST", ca.addNewMemberSuccess, ca.activeAccountFailure, data);
			
	    if(data.email == "" || data.uname == "" || data.upass == ""){
	    	li.alertModal("Please fill in all information.");
	    }else{
	    	li.alertModal("Account is being built.");
	    	mo.asynch(request);
	    }
		 
        
	},
	
	resendValidation: function(){
		
		var data = {
			 	umail: $("._newUserEmail").val()
			 }, 
			 url = 'resendvalidation',
			 request = new mo.requestObject(url, "POST", ca.resendValidationSuccess, ca.resendValidationFailure, data);
			 
	     if(data.email == ""){
	     	li.alertModal("Please provide an email address.");
	     }else{
	     	mo.asynch(request);
	     }
		 
		 
	},
	
	
	
	
	resetPassword: function(){
		
		var data = {
			 	umail: $("._newUserEmail").val() //Change to use both id and class
			 }, 
			 url = 'resetpassword',
			 request = new mo.requestObject(url, "POST", ca.resetPasswordSuccess, ca.resetPasswordFailure, data);
		 
		 mo.asynch(request);
	},
	
	resetPassUpdate:function(){
		var locat = ""+window.location;
		locat = locat.replace("modobot.com/ModoMain/public/resetaccountpass?token=","");
		//locat = locat.replace("http://localhost/ModoMain/public/resetaccountpass?token=","");
		locat = locat.replace("://","");
		locat = locat.replace("https","");
		locat = locat.replace("https","");
		
		var data = {
			uname : $('#passResetUsername').val(),
			upass : encodeURIComponent($('#resetPass1').val()),
			upass2 :encodeURIComponent($('#resetPass2').val()),
			token : locat
		},
		url = 'resetpassupdate';
		if(data.upass===data.upass2 && data.upass!="" && data.uname !=""){
			var request = new mo.requestObject(url, "POST", ca.resetPasswordViewSuccess, ca.resetPasswordViewFailure, data);
			mo.asynch(request);
			$('#passResetUsername').val("");
			$('#resetPass1').val("");
			$('#resetPass2').val("");
		 }else{
		 	li.alertModal("Input is invalid");
		 }
	},
	
	clearLog: function(){
		
		$("#statusLogContent").empty();
	},
	
	contact: function(){
		//console.log("Show contact form");
		var contactView = buildContact();
		
		//throw it into a dialog and display
		$("#modals").html(contactView).dialog(
			{
				modal: true,
				width: 800,
				height: 500,
				dialogClass: 'modalDialog',
				title: "Contact Us"
			}
		);
		
		$(".ui-dialog-titlebar-close").html("X");
	},
	
    sendContact: function(){
    	
    	var data = {
    		cAddress : $("#cAddress").val(),
    		cSubject : $("#cSubject").val(),
    		cMessage : $("#cMessage").val()
    		
    	},
    	    url = "submitcontact",
    	    request = new mo.requestObject(url, "GET", ca.sendContactSuccess, ca.sendContactFailure, data);
    	    
    	if(  data.cAddress == "" || data.cSubject == "" || data.cMessage == ""){
    		li.alertModal("Please fill in all fields.");
    	}else{
    		mo.asynch(request);
    	}
    	    
    	
    },
    
    confighandle: function(){
    	
    	$(".confighandle").click(function(){
    		
    		//NOTE:: 'open' is a fake class used for view manipulation. There should not be an
    		//       actual css class
    		
    		if( $(this).hasClass('open') ){
    			$(".confighandle").removeClass('handleshow', 800);
    			$(".bothelp").removeClass('bothelpShow', 800);
    			$(this).removeClass('open', 800);
    			$(".confighandle .handle").attr("title", "Show Bot configuration options");
    			$(this).find("i").removeClass("rotate");

    		}else{
    			$(".confighandle").addClass('handleshow', 800);
    			$(".bothelp").addClass('bothelpShow', 800);
    			$(this).addClass('open', 800);
    			$(".confighandle .handle").attr("title", "Hide Bot configuration options");
    			$(this).find("i").addClass("rotate");
    		}
    		
    	});
    },
    
    accounthandle: function(){
    	
    	$(".accounthandle").click(function(){
    		
    		//NOTE:: 'open' is a fake class used for view manipulation. There should not be an
    		//       actual css class
    		
    		if( $(this).hasClass('open') ){
    			$(".accounthandle").removeClass('handleshow', 800);
    			$(".accounthelp").removeClass('bothelpShow', 800);
    			$(this).removeClass('open', 800);
    			$(".accounthandle .handle").attr("title", "Open Registration Steps");
    			$(this).find("i").removeClass("rotate");

    		}else{
    			$(".accounthandle").addClass('handleshow', 800);
    			$(".accounthelp").addClass('bothelpShow', 800);
    			$(this).addClass('open', 800);
    			$(".accounthandle .handle").attr("title", "Close Registration Steps");
    			$(this).find("i").addClass("rotate");
    		}
    		
    	});
    	
    },
    
    reviewshandle: function(){
    	
    	$(".reviewshandle").click(function(){
    		
    		//NOTE:: 'open' is a fake class used for view manipulation. There should not be an
    		//       actual css class
    		
    		if( $(this).hasClass('open') ){
    			$(".reviewshandle").removeClass('handleshow', 800);
    			$(".reviews").removeClass('bothelpShow', 800);
    			$(this).removeClass('open', 800);
    			$(".reviewshandle .handle").attr("title", "Open Reviews");
    			$(this).find("i").removeClass("rotate");

    		}else{
    			$(".reviewshandle").addClass('handleshow', 800);
    			$(".reviews").addClass('bothelpShow', 800);
    			$(this).addClass('open', 800);
    			$(".reviewshandle .handle").attr("title", "Hide Reviews");
    			$(this).find("i").addClass("rotate");
    		}
    		
    	});
    	
    },
    
    privacyhandle: function(){
    	
    	$(".privacyhandle").click(function(){
    		
    		//NOTE:: 'open' is a fake class used for view manipulation. There should not be an
    		//       actual css class
    		
    		if( $(this).hasClass('open') ){
    			$(".privacyhandle").removeClass('handleshow', 800);
    			$(".privacypolicy").removeClass('bothelpShow', 800);
    			$(this).removeClass('open', 800);
    			$(".privacyhandle .handle").attr("title", "Open Privacy Policy");
    			$(this).find("i").removeClass("rotate");

    		}else{
    			$(".privacyhandle").addClass('handleshow', 800);
    			$(".privacypolicy").addClass('bothelpShow', 800);
    			$(this).addClass('open', 800);
    			$(".privacyhandle .handle").attr("title", "Hide Privacy Policy");
    			$(this).find("i").addClass("rotate");
    		}
    		
    	});
    	
    },
    
    showHidePassword: function(){
    	
    	//showHidePassword
    	//console.log( $("#showHidePassword" ).is(":checked") );
    	
    	if(  $("#showHidePassword" ).is(":checked") ){
    		//show password
    		$("#newUserPass").attr("type", "text");
    		//$("#showHidePassword").val(false);
    	}else{	
    		//hide password
    		$("#newUserPass").attr("type", "password");
    		//$("#showHidePassword").val(true);
    	}
    	
    },
    
  	alertModal : function(message){
		$('#alertModals').html(message).dialog({
			width : 325,
			height : 200,
			title : "Alert",
			dialogClass : "modalDialog",
			buttons : {
				Close : function(){
					$(this).dialog("close");
				}
			}
		});
	},
	
	fixed_sell_amount_keyup : function(){
		$('#fixed_sell_amount').keyup(function() {
			var fixed_sell_amount = $("#fixed_sell_amount").val().replace(/[^\d.]/g,"");
    	   	$("#fixed_sell_amount").val(fixed_sell_amount);
		});
	},
	
	fixed_buy_amount_keyup : function(){
		$('#fixed_buy_amount').keyup(function() {
			var fixed_buy_amount = $("#fixed_buy_amount").val().replace(/[^\d.]/g,"");
    	   	$("#fixed_buy_amount").val(fixed_buy_amount);
		});
	},
	
	sellLimitBtc_keyup : function(){
		$('#sellLimitBtc').keyup(function() {
			var sellLimitBtc = $("#sellLimitBtc").val().replace(/[^\d.]/g,"");
    	   	$("#sellLimitBtc").val(sellLimitBtc);
		});
	},
	
	buyLimitBtc_keyup : function(){
		$('#buyLimitBtc').keyup(function() {
			var buyLimitBtc = $("#buyLimitBtc").val().replace(/[^\d.]/g,"");
    	   	$("#buyLimitBtc").val(buyLimitBtc);
		});
	},
	
};
