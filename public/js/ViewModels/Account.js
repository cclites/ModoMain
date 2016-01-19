var buildAccountView = function()
{
    var b = model.bots();
	var myB = b[0];
	var live = myB.configs.live();

	str ='';
	str += '<div id="accountManagement">';
	str += '  <nav id="accountNav">';
	str += '    <ul>';
	str += "      <li><span onclick=\"showAccountConfig('accountPassword')\" >Update Password</span></li>";
	str += "      <li><span onclick=\"showAccountConfig('accountEmail')\">Update Email</span></li>";
	str += "      <li><span onclick=\"showAccountConfig('activateAccount')\">Activate Account</span></li>";
	
	if(live == 1)
	{
	    str += "      <li><span onclick=\"showAccountConfig('bitstampCfgs')\">Update Bitstamp Configs</span></li>";
	}
	
	str += '    </ul>';
	str += '  </nav>';
	str += '  <div id="accountConfigDivs">';
	str += '    <div class="accountAction" id="accountPassword">';
	str += buildRestPasswordView();
	str += '    </div>';
	str += '    <div class="accountAction" id="accountEmail">';
	str += buildResetEmail();
	str += '    </div>';
	str += '    <div class="accountAction" id="activateAccount">';
	str += buildAccountActivate();
	str += '    </div>';
	
	if(live == 1)
	{
	    str += '    <div class="accountAction" id="bitstampCfgs">';
	    str += buildBitstampCfg();
	    str += '    </div>';
	}
	
	str += '</div>';
	
	return str;
}


var buildRestPasswordView = function()
{
	str ='';
	str +='  <table id="resetPassword">';
	str +='    <tr>';
	str +='      <td class="accountLabel">Enter new Password:</td>';
	str +='      <td><input type="password" id="newPass1"/></td>';
	str +='    </tr>';
	str +='    <tr>';
	str +='      <td class="accountLabel">Re-enter new Password:</td>';
	str +='      <td><input type="password" id="newPass2"/></td>';
	str +='    </tr>';
	str +='    <tr>';
	str +='      <td colspan="2"><button type="button" class="action accountButton" onclick="saveNewPass()">Save New Password</button></td>';
	str +='    </tr>';
	str +='  </table>';
	
	return str;
}

var buildResetEmail = function()
{
    str ='';
	str +='  <table id="resetEmail">';	
	str +='    <tr>';	
	str +='      <td class="accountLabel">Enter new Email:</td>';	
	str +='      <td><input type="text" id="newMail"/></td>';	
	str +='    </tr>';	
	str +='    <tr>';	
	str +='      <td colspan="2"><button type="button" class="action accountButton" onclick="saveNewEmail()">Save New Email</button></td>';	
	str +='    </tr>';	
	str +='  </table>';	

    return str;
}

var buildBitstampCfg = function()
{
	str ='';
	str +='  <table id="bitstampCfgsTable">';	
	str +='    <tr>';
	str +='    <tr>';	
	str +='      <td class="accountLabel">Account id:</td>';	
	str +='      <td><input type="text" id="acctId"/ required="required"></td>';	
	str +='    </tr>';	
	str +='      <td class="accountLabel">Bitstamp API Key</td>';	
	str +='      <td><input type="password" id="key" required="required"/></td>';	
	str +='    </tr>';
	str +='    <tr>';	
	str +='      <td class="accountLabel">Bitstamp Secret:</td>';	
	str +='      <td><input type="password" id="secret" required="required"/></td>';	
	str +='    </tr>';
	str +='    <tr>';	
	str +='      <td colspan="2"><button type="button" class="action accountButton" onclick="updateBitstampConfigs()">Save Configs</button></td>';	
	str +='    </tr>';	
	str +='  </table>';	

    return str;
}

var buildAccountActivate = function()
{
    var b = model.bots(),
	    myB = b[0],
		last = myB.ticker.last(),
	    mnth = 4,
	    reg = 16;
	    regFee = reg/last,
		mnthFee = mnth/last;
		
	str = '';
	str += "<div id='disclaimer'><b>Disclaimer:</b> Modobot.com is for entertainment purposes only. Performance is dependent on market conditions and operator performance."+
	       "This service is provided as-is, with no guarantees or warranties. All accounts will be manually activated.</div>";
    str += "<br>";
	
	str += "<div><b>Pricing:</b> During beta-testing, a limited number of bots will be allowed free limited live access. In order to activate your bot for live trades, you must sign up for an account on the support forum and respond to the Bot Activation Request thread. Activation may take up to 24 hours. Bots will be limited to 1฿ per trade on free accounts.</div>";
	
	//str += "<div><b>Pricing:</b> During beta-testing, registration will be " + regFee.toFixed(3) + "฿, and monthly service fees will be " + mnthFee.toFixed(3)+ "฿ </div>";
	//str += "<br>";
	
	//str += "<div><b>Activation: </b>  To activate your bot, submit <b>" + (regFee + mnthFee).toFixed(3) +  "฿</b> to the following address:</div>";
	//str += "<div><b>" + model.address() + "</b></div>";
	//str += "<div style='margin-bottom: 5px;'>Then click on the activation button. You will recieve an email when your account has been activated. Activation may take up to 24 hours.</div>";
	//str += "<button id='sendActivation' class='action' onclick='activate()'>Send Activation Notice</button>";
	
	return str;
}

 