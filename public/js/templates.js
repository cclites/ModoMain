var tem = {
	
	buildTransactionView: function(transactions){
		
		console.log(transactions);
		
		var str = "";
	
		if(transactions.transactions.length < 1)
		{
			return "<span>There are no transactions to display.</span>";
		}
		
		for(var i = 0; i<transactions.transactions.length; i += 1)
		{
			
			var tBtc = (transactions.transactions[i]["amount"]*transactions.transactions[i]["price"]);

			str += "<table class='transactionTable'>\n" +
			     "    <thead>\n" +
			     
			     "        <tr>\n " +
				 "          <th>Date</th>\n " +
				 "          <th>Type</th>\n " +
				 "          <th>Price(USD)</th>\n " +
				 "          <th>Total Cost(USD)</th>\n " +
				 "          <th>Amount(BTC)</th>\n " +
				 "        </tr>\n " +
			     
			     "    </thead>\n" +
			     
			     "    <tbody>\n" +

				 "        <tr>\n " +
				 "             <td>" + transactions.transactions[i]["datetime"]+ "</td>\n " +
				 "             <td>" + transactions.transactions[i]["category"]+ "</td>\n " +
				 "             <td>$" + parseFloat(transactions.transactions[i]["price"]).toFixed(2)+ "</td>\n " +
				 "             <td>$" + transactions.transactions[i]["amount"] + "</td>\n " +
				 "            <td>" + ( parseFloat(transactions.transactions[i]["amount"]) / parseFloat(transactions.transactions[i]["price"]) ).toFixed(2) + "</td>\n " +
				 "        </tr>\n " +
				 "    </tbody>\n" +
				 "</table>\n";
			
		}
		return str;	
		
	},
	
	buildAccountView: function(){
		
		var str = '<div id="accountManagement">' +
		      '  <nav id="accountNav">' +
		      '    <ul>' +
		      "      <li><span class=\"accountMenu\" onclick=\"li.showAccountConfig('#accountPassword')\" >Update Password</span></li>" +
		      "      <li><span class=\"accountMenu\" onclick=\"li.showAccountConfig('#accountEmail')\">Update Email</span></li>" +
		      "      <li><span class=\"accountMenu\" onclick=\"li.showAccountConfig('#activateAccount')\">Activate Account</span></li>";
		      
		if(model.paid == 1){
			str += "      <li><span class=\"accountMenu\" onclick=\"li.showAccountConfig('#emailNotification')\">Email Notifications</span></li>";
		}
		
		if(model.paid == 1)
		{
		    str += "      <li><span class=\"accountMenu\"onclick=\"li.showAccountConfig('#bitstampCfgs')\">Update Bitstamp Configs</span></li>";
		}
		
		
		str += '    </ul>' +
			   '  </nav>' +
			   '  <div id="accountConfigDivs">' +
		       '    <div class="accountAction" id="accountPassword">' +
		        tem.buildRestPasswordView() +
		         '    </div>' +
		         '    <div class="accountAction" id="accountEmail">' +
		         tem.buildResetEmail() +
		         '    </div>' +
		         '    <div class="accountAction" id="activateAccount">' +
		         tem.buildAccountActivate() +
		         '    </div>';
		
		if(ko_models.bot.bot[0].is_active==1 && ko_models.bot.activated[0]==1&& ko_models.bot.bot[0].trades>0){
			str += '    <div class="accountAction" id="emailNotification">' +
		            tem.buildEmailNotification() +
		           '    </div>';
		}
		//live gets set when the email is validated.

		if(ko_models.bot.bot[0].live == "1" && model.paid == 1)
		{
			
		    str += '    <div class="accountAction" id="bitstampCfgs">' +
		           tem.buildBitstampCfg() +
		           '    </div>';
		           
		}
		
		
		str += '</div>';
		
		return str;
	},
	
	buildRestPasswordView : function(){

		var str = '  <table id="resetPassword">' +
			'    <tr>' +
			'      <td class="accountLabel">Enter new Password:</td>' +
			'      <td><input type="password" id="newPass1"/></td>' +
			'    </tr>' +
			'    <tr>' +
			'      <td class="accountLabel">Re-enter new Password:</td>' +
			'      <td><input type="password" id="newPass2"/></td>' +
			'    </tr>' +
			'    <tr>' +
			'      <td colspan="2"><button type="button" class="action accountButton" onclick="li.saveNewPass()">Save New Password</button></td>' +
			'    </tr>' +
			'  </table>';
		
		return str;
	},

    buildResetEmail : function(){

		var str = '  <table id="resetEmail">' +
			'    <tr>' +
			'      <td class="accountLabel">Enter new Email:</td>' +	
			'      <td><input type="text" id="newMail"/></td>' +
			'    </tr>' +
			'    <tr>' +
			'      <td colspan="2"><button type="button" class="action accountButton" onclick="li.saveNewEmail()">Save New Email</button></td>' + 	
			'    </tr>' +
			'  </table>';	
	
	    return str;
	},

    buildBitstampCfg : function(){
    	
    	//do not do this if not paid.
    	if(model.paid == 0){
    		return;
    	}

		var str ='  <table id="bitstampCfgsTable">' +	
			'    <tr>' +
			'    <tr>' +	
			'      <td class="accountLabel">Account id:</td>' +	
			'      <td><input type="text" id="acctId"/ required="required"></td>' +	
			'    </tr>' +
			'      <td class="accountLabel">Bitstamp API Key</td>' +	
			'      <td><input type="password" id="key" required="required"/></td>' +	
			'    </tr>' +
			'    <tr>' +
			'      <td class="accountLabel">Bitstamp Secret:</td>' +	
			'      <td><input type="password" id="secret" required="required"/></td>' +	
			'    </tr>' +
			'    <tr>' +
			'      <td colspan="2"><button type="button" class="action accountButton" onclick="li.updateBitstampConfigs()">Save Configs</button></td>' +	
			'    </tr>' +
			'  </table>';
	
	    return str;
	},
	
	buildEmailNotification : function(){
		
		//do not do this if not paid.
    	if(model.paid == 0){
    		return;
    	}
		
		var str = "  <div><br>\n"+
	    		  "Notify when transaction occurs.<input type='checkbox' id='transNotify' onclick='li.selectTransactionNotification()'><br><br>\n"+
	    		  "Notify me at this price (in USD): "+
	    		  "<input type='text' id='priceNotification' name='price'> <button id='' value='Submit' onclick='li.priceNotification()' type='submit'>Submit</button><br>\n "+
	    		  "</div>";
		return str;	
	},
	
    buildAccountActivate : function()
	{
			
		/*	
		var str = "<div id='disclaimer'><b>Disclaimer:</b> Modobot.com is for entertainment purposes only. Performance is dependent on market conditions and operator performance." +
		       "This service is provided as-is, with no guarantees or warranties. All accounts will be manually activated.</div>" +
	           "<br>" +
	           "<button class='action' onclick='li.activateAccount();'>Activate Account</button>";
	           if(ko_models.bot.activated[0]==1){
	           	str+="<br><br>"+
	           	"Wallet Address:  "+ko_models.bot.bot[0].wallet;
	           }
		return str;
		*/
	},
	//'<div><span>Wallet Adress: </span><span>' + ko_models.bot.bot[0].wallet + "<\span><\div>";
	buildNewAccountView : function(){
		
		var str = '<form>' +
		          
		
		          '    <br>' +
		
		          '<div id="newAccountDisclaimer">' +
		          'Modobot is provided for entertainment purposes only, and is not intended as a viable investment strategy. Bot performance is dependant on market conditions and individual operation. No claims of profitability are implied. It is the responsibility of the  operator to familiarize themselves with ModoBot functionality before making live trades. Please select a secure password that is unique to this site.<br><br>Modobot.com requires a linked Bitstamp account for live trading.' +
		          
		          '  </div>' +
		          
		          '  <div id="accountMessage">' +
		          '    Once your account is registered, you will receive an auto-generated email with a validation url. ModoBot will only work in test mode until your email has been validated.' +
		          '  <br><br>' +
		          '<b>For more information, check out the sidebar menu.</b>' +
		          '</div>' +
		
		          '    <br>' +
		          '        ' +
		          '  <input type="text" class="_newUserName" id="newUserName" placeholder="Enter User Name">' +
		          '    <br>' +
		          '  <input type="text" class="_newUserEmail" id="newUserEmail" placeholder="Enter Email Address">' +
		          '    <br>' +
		          '  <input type="password" class="_newUserPass" id="newUserPass" placeholder="Enter Password" >' +
		          '    <br>' +
		          '  <input type="button" class="action" id="createAccount" onclick="li.addNewMember()" value=" Submit "/>' +
		          '  <button class="action" id="resendValidate" onclick="li.resendValidation()">Resend Validation</button>' +
		          '  <button class="action" id="changePassword" onclick="li.resetPassword()">Reset Password</button>' +
		          '</form>';
		
		
	    return str;	
	},
	
	newPasswordReset: function(){
		
		return view('newPasswordReset');
	},
	
	showStatusAsSaved: '<span>Configuration Saved.<i class="fa fa-heart saveStatus"></i></span>',
	
	showStatusAsDirty: '<span>Configuration Not Saved.<i class="fa fa-heart-o saveStatus"></i></span>',
	
	showStatusAsSaving: '<span>Saving Configuration.<i class="fa fa-heartbeat saveStatus"></i></span>',
	
	buildContact: function(){
	    var str = "";
	  
	    var str = "  <h3>Please send any questions, comments, or suggestions</h3>\n" +
			      "  <form>\n" +
			      "    <div><label>ContractAddress:</label><input id='cAddress'></div>\n" +
			      "      <br>\n" +
			      "    <div><label>Subject:</label><input id='cSubject'></div>\n" +
			      "      <br>\n" +
			      "    <div><label>Message:</label><textarea id='cMessage'></textarea></div>\n" +
			      "      <br>\n" +
			      "    <div id='contactSubmit' class='divAsButton'>Submit</div>" +
			      "  </form>\n";
	},
	
	buildAdminView:function(data){	  
	    var str = "  <div id='adminViewInputs'>"+
	    		  "   	<div> <label>Type: </label><input id='adminMessageType'></input></div>\n"+
	    		  "  	<br>\n"+
			      "  	<div> <label>Message: </label><textarea id='adminMessage'></textarea></div>\n" +
			      "  	<br>\n"+
			      "  </div>\n"+
			      "	 <div id='userEmails'>\n";
					
		for(var i=0;i<data.users.length;i++){
			str += "<input type='checkbox' class='allUserEmails "+data.users[i].ring+"ring' id='"+data.users[i].id+"user'>"+data.users[i].email+"<br>\n";
		}
		
	    str += 	  "  </div><br>\n"+
	    		  "<input type='checkbox' id='selectAllUsers' onclick='li.selectAllUsers()'>Select All Users<br>\n"+
	    		  "<input type='checkbox' id='selectNormalUsers' onclick='li.selectNormalUsers()'>Select Normal Users<br>\n"+
	    		  "<input type='checkbox' id='selectAdminUsers' onclick='li.selectAdminUsers()'>Select Admin Users<br>";
	    		  
		return str;
	},

	
	
};

