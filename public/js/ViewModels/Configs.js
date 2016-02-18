function buildConfigView(){
	
	//console.log(Object.keys(ko_models.bot.bot[0]));
	//console.log( ko_models.bot.bot[0].live  );
	
	// manually handle which bot gets processed.
	  var b = ko_models.bot.bot[0],
          myB = b,
          id = myB.id,
          str = "",
          temp = "",
          live = myB.live;

	
	//(myB.exchange_fee())
	
	str += "    <div class='sectionHeader'>Configuration:</div>\n";
	str += "    <table id='configSummary' class='configSummary'>\n"; 
	str += "            <tr>\n";
	
	str += "                     <td class='configLabel'>Is Active</td>\n"; 
	
	temp = myB.is_active;
	
	if ( temp == 1)
	{
		str += "                     <td><input id='isActive' checked='checked' type='checkbox'></td>\n";  
	}
	else
	{
		str += "                     <td><input id='isActive' type='checkbox'></td>\n";
	}
	
	str += "                     <td>&nbsp;</td>\n"; 
	str += "                     <td>&nbsp;</td>\n"; 
	str += "                     <td colspan='4'>&nbsp;</td>\n";
	str += "                 </tr>\n"; 
	
	str += "                 <tr>\n"; 
	str += "                     <td class='configLabel'>Testing Mode</td>\n"; 
	
	temp = myB.testing_mode;
	
	if ( myB.testing_mode == 1 )
	{
		str += "                     <td><input id='isTesting' checked='checked' type='checkbox'></td>\n";
	}
	else
	{
		str += "                     <td><input id='isTesting' type='checkbox'></td>\n";
	}
	
	str += "                     <td class='configLabel'>Base $</td>\n"; 
	
	temp = myB.base;
	
	str += "                     <td><input id='base' onkeyup='mo.updateMargins()' value='" + temp +"' size='8' type='text'></td>\n";

	str += "                      <td class='configLabel' colspan='2'>Margin Sale Price</td>\n";
	str += "                      <td id='marginSalePrice'>$0</td>\n";
	
	str += "                 </tr>\n"; 
	str += "                <tr>\n";
	str += "                     <td class='configLabel'>Auto Buy</td>\n"; 
	
	temp = myB.can_buy;
	
	if ( temp == 1)
	{
		str += "                     <td><input id='isBuying' checked='checked' type='checkbox'></td>\n"; 
	}
	else
	{
		str += "                     <td><input id='isBuying' type='checkbox'></td>\n";
	}
	str += "                     <td class='configLabel'>% Increase</td>\n"; 
	
	temp = myB.increase*100;
	
	      
	
	 str +=      "                     <td><input id='increase' onkeyup='mo.updateMargins()' size='8' value='" + parseFloat(temp).toFixed(2) + "'  type='text'></td>\n" +
	 "                      <td class='configLabel' colspan='2'>Margin Buy Price</td>\n" +
	       "                      <td id='marginPurchasePrice'>$0</td>\n" +
	       "                     <td>&nbsp;</td>\n" +
	       "                     <td id='sellLimitUsd'>&nbsp;</td>\n" + 
	       "                     <td>&nbsp;</td>\n" + 
	       "                      <td id='buyLimitUsd'>&nbsp;</td>\n" +
	       "                 </tr>\n" +
	       "                 <tr>\n" +
	       "                     <td class='configLabel'>Auto Sell</td>\n"; 
	
	temp = myB.can_sell;
	if ( temp == 1)
	{
		str += "                     <td><input id='isSelling' checked='checked' type='checkbox'></td>\n"; 
	}
	else
	{
		str += "                     <td><input id='isSelling' type='checkbox'></td>\n"; 
	}
	
	str += "                     <td class='configLabel'>% Decrease</td>\n";
	
	temp = myB.decrease*100;
	str += "                     <td><input id='decrease' onkeyup='mo.updateMargins()' size='8' value='" + parseFloat(temp).toFixed(2) + "' type='text'></td>\n"; 
	
	str += "                     <td class='configLabel' colspan='2'>Sell Limit Btc</td>\n";
	
	temp = myB.sell_limit_btc;
	str += "                     <td><input id='sellLimitBtc' onkeyup='li.sellLimitBtc_keyup()'size='6' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	
	 
	
	str += "                 </tr>\n";
	
	
	str += "                 <tr>\n";
	str += "                     <td class='configLabel'>Fixed Sell</td>\n";
	
	temp = myB.fixed_sell;
	
	if ( temp == 1)
	{
	    str += "                     <td><input id='fixed_sell' type='checkbox' checked='checked'></td>\n";
	}
	else
	{
		str += "                     <td><input id='fixed_sell' type='checkbox'></td>\n";
	}
	
	temp = myB.fixed_sell_amount;
	str += "                     <td class='configLabel'>Sell Price $</td><td><input id='fixed_sell_amount' onkeyup='li.fixed_sell_amount_keyup()' size='8' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	
	str += "                     <td class='configLabel' colspan='2'>Buy Limit Btc</td>\n";
	temp = myB.buy_limit_btc;
	str += "                     <td><input id='buyLimitBtc' onkeyup='li.buyLimitBtc_keyup()' size='6' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	
	str += "                 </tr>\n";
	
	str += "                 <tr>\n";
	str += "                     <td class='configLabel'>Fixed Buy</td>\n";
	
	
	temp = myB.fixed_buy;
	if ( temp == 1)
	{
	     str += "                     <td><input id='fixed_buy' type='checkbox' checked='checked'></td>\n";
	}
	else
	{
	     str += "                     <td><input id='fixed_buy' type='checkbox'></td>\n"; 	
	}
	temp = myB.fixed_buy_amount;
	str += "                     <td class='configLabel'>Buy Price $</td><td><input id='fixed_buy_amount' onkeyup='li.fixed_buy_amount_keyup()' size='8' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	str += "                 </tr>\n";
	 
	
	str += "                 <tr  id='spacer'><td></td></tr>\n"; 
	str += "             </tbody>\n";			
	str += "        </table>\n";  //end of configSummary table
	
	return str;
}