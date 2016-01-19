var buildTransactionView = function(transactions)
{
	var str = "";
	
	if(transactions.length < 1)
	{
		return "<span>There are no transactions to display.</span>";
	}
	
	for(var i = 0; i<transactions.length; i += 1)
	{
	    var tBtc = (transactions[i]["amount"]*transactions[i]["price"]);
  
        //str += "<div class='headerBar'>&nbsp;</div>\n";
		str += "<table class='transactionTable'>\n";
		str += "    <tr>\n";
		str += "    <td class='headerBar' colspan='6'>&nbsp;</td>\n";
		str += "    </tr>\n";
		str += "    <tr>\n";
		str += "      <th>Date</th>\n";
		str += "      <th>Type</th>\n";
		str += "      <th>Price(USD)</th>\n";
		str += "      <th>Total Cost(USD)</th>\n";
		str += "      <th>Fee(USD)</th>\n";
		str += "      <th>Amount(BTC)</th>\n";
		str += "    </tr>\n";
		str += "    <tr>\n";
		str += "      <td>" + transactions[i]["datetime"]+ "</td>\n";
		str += "      <td>" + transactions[i]["category"]+ "</td>\n";
		str += "      <td>$" + parseFloat(transactions[i]["price"]).toFixed(2)+ "</td>\n";
		str += "      <td>$" + parseFloat(tBtc).toFixed(2)+ "</td>\n";
		str += "      <td>$" + parseFloat(transactions[i]["fee"]).toFixed(2)+ "</td>\n";
		str += "      <td>" + parseFloat(transactions[i]["amount"]).toFixed(4)+ "</td>\n";
		str += "    </tr>\n";
		
		str += "</table>\n";
		
	}
	return str;	
}

