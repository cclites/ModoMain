var buildNewAccountView = function()
{
	str = '';
	str += '<form>';
	str += '  <div id="accountMessage">';
	str += '    <b>Welcome!</b> We are taking sign-ups for beta testing on a limited basis. For questions and help, please contact: support@modobot.com';
	str += '    <br><br>';
	str += '    Once your account is registered, you will recieve an auto-generated email with a validation url. Please click on the link in the email to validate your account. Once your email is validated, you will be able to log in.';
	str += '</div>';
	
	str += '    <br>';
	
	str += '<div id="newAccountDisclaimer">';
	str += 'Modobot is provided for entertainment purposes only, and is not intended as a viable investment strategy. Bot performance is dependant on market conditions and individual operation. No claims of profitability are implied. It is the responsibility of the  operator to familiarize themselves with ModoBot functionality before making live trades. Please select a secure password that is unique to this site.<br><br>Modobot.com requires a linked Bitstamp account for live trading.';
	str += '  </div>';
	
	str += '    <br>';
	str += '        ';
	str += '  <input type="text" id="newUserName" placeholder="Enter User Name" required="required">';
	str += '    <br>';
	str += '  <input type="text" id="newUserEmail" placeholder="Enter Email Address" required="required">';
	str += '    <br>';
	str += '  <input type="password" id="newUserPass" placeholder="Enter Password" required="required">';
	str += '    <br>';
	str += '  <input type="button" class="action" id="createAccount" onclick="addNewMember()" value=" Submit "/>';
	str += '  <button class="action" id="resendValidate" onclick="resendValidation()">Resend Validation</button>';
	str += '  <button class="action" id="recoverPassword" onclick="recoverPassword()">Reset Password</button>';
	str += '</form>';
	
	
    return str;	
}