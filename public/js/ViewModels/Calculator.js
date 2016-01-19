function buildCalculatorView()
{
	//console.log(Object.keys(ko_models.bot.bot[0]));
	
	// manually handle which bot gets processed.
	var b = ko_models.bot.bot[0],
	    myB = b,
	    id = myB.id;

	str = "";
	str += "    <div class='sectionHeader'>Calculator:</div>\n";
	str += "        <table class='calculatorTable'>\n"; 
	str += "            <tr>\n"; 
	str += "                <td class='calculatorLabel'>New SPP</td><td id='newSpp'>$0</td>\n"; 
	
	str += "                <td class='calculatorLabel'>Sell Spread</td><td id='sellSpread'>$0</td>\n";
	//str += "                <td class='calculatorLabel'>Sell Fee</td><td id='sellFee'>$0</td>\n"; 
	str += "                <td class='calculatorLabel'>Actual</td><td id='actualSellSpread'>$0</td>\n";
	str += "            </tr>\n"; 
	str += "            <tr>\n"; 
	str += "                <td class='calculatorLabel'>New PPP</td><td id='newPpp'>$0</td>\n"; 
	str += "                <td class='calculatorLabel'>Buy Spread</td><td id='buySpread'>$0</td>\n"; 
	//str += "                <td class='calculatorLabel'>Buy Fee</td><td id='buyFee'>$0</td>\n"; 
	str += "                <td class='calculatorLabel'>Actual</td><td id='actualBuySpread'>$0</td>\n"; 
	str += "            </tr>\n"; 
	str += "            <tr  id='spacer'><td></td></tr>\n"; 
	str += "            <tr>\n"; 

	str += "            </tr>\n"; 
	str += "        </table>\n";
	
	return str;
}

function populateCalculator(){
	
}
