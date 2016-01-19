function buildActionView()
{

	var str = "            <input class='action' id='update' onclick='li.updateConfigs();' value='Update Configuration' type='button'>\n";
	str += "               <input class='action' id='resetBalance' onclick='li.resetBalance()' value='Reset Test Balance' type='button'>\n";
	str += "               <input class='action' id='resetHistory' onclick='li.resetHistory()' value='Reset Historic Data' type='button' />\n"; 
	str += "               <input class='action' id='getTransactions' onclick='li.getTransactions()' value='View Transactions' type='button' />\n"; 

	return str;
}