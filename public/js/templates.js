var tem = {
	
	buildTransactionView: function(transactions){
		
		var str = "";
	
		if(transactions.transactions.length < 1)
		{
			return "<span>There are no transactions to display.</span>";
		}
		
		for(var i = 0; i<transactions.transactions.length; i += 1)
		{
			
			var tBtc = (transactions.transactions[i]["amount"]*transactions.transactions[i]["price"]);

			str += "<table class='transactionTable'>\n" +
				 "    <tr>\n " +
				 "    <td class='headerBar' colspan='6'>&nbsp;</td>\n " +
				 "    </tr>\n " +
				 "    <tr>\n " +
				 "      <th>Date</th>\n " +
				 "      <th>Type</th>\n " +
				 "      <th>Price(USD)</th>\n " +
				 "      <th>Total Cost(USD)</th>\n " +
				 "      <th>Fee(USD)</th>\n " +
				 "      <th>Amount(BTC)</th>\n " +
				 "    </tr>\n " +
				 "    <tr>\n " +
				 "      <td>" + transactions.transactions[i]["datetime"]+ "</td>\n " +
				 "      <td>" + transactions.transactions[i]["category"]+ "</td>\n " +
				 "      <td>$" + parseFloat(transactions.transactions[i]["price"]).toFixed(2)+ "</td>\n " +
				 "      <td>$" + parseFloat(tBtc).toFixed(2)+ "</td>\n " +
				 "      <td>$" + parseFloat(transactions.transactions[i]["fee"]).toFixed(2)+ "</td>\n " +
				 "      <td>" + parseFloat(transactions.transactions[i]["amount"]).toFixed(4)+ "</td>\n " +
				 "    </tr>\n " +
				 "</table>\n";
			
		}
		return str;	
		
	},
	
	buildAccountView: function(){
		
		var str = '<div id="accountManagement">' +
		      '  <nav id="accountNav">' +
		      '    <ul>' +
		      "      <li><span onclick=\"li.showAccountConfig('#accountPassword')\" >Update Password</span></li>" +
		      "      <li><span onclick=\"li.showAccountConfig('#accountEmail')\">Update Email</span></li>" +
		      "      <li><span onclick=\"li.showAccountConfig('#activateAccount')\">Activate Account</span></li>";
	
		//if(ko_models.bot.live == 1)
		//{
		    str += "      <li><span onclick=\"li.showAccountConfig('#bitstampCfgs')\">Update Bitstamp Configs</span></li>";
		//}
		
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
		
		//if(ko_models.bot.live == 1)
		//{
		    str += '    <div class="accountAction" id="bitstampCfgs">' +
		           tem.buildBitstampCfg() +
		           '    </div>';
		//}
		
		str += '</div>';
		
		return str;
	},
	
	buildRestPasswordView : function(){

		str = '  <table id="resetPassword">' +
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

		str = '  <table id="resetEmail">' +
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

		str ='  <table id="bitstampCfgsTable">' +	
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

    buildAccountActivate : function()
	{
			
		str = "<div id='disclaimer'><b>Disclaimer:</b> Modobot.com is for entertainment purposes only. Performance is dependent on market conditions and operator performance." +
		       "This service is provided as-is, with no guarantees or warranties. All accounts will be manually activated.</div>" +
	           "<br>" +
		       "<div><b>Pricing:</b> During beta-testing, a limited number of bots will be allowed free limited live access. In order to activate your bot for live trades, you must sign up for an account on the support forum and respond to the Bot Activation Request thread. Activation may take up to 24 hours. Bots will be limited to 1฿ per trade on free accounts.</div>";
		
		return str;
	},
	
	
	
};

