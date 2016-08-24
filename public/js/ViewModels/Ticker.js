function buildTickerView()
{
    //Selected ticker depends on the cookie value
    //var tickerCurrency = '';
    var useTicker = '',
        usdSelected = "",
        eurSelected = "",   
        ds = "$";
    
    if(model.currency === 'usd'){
    	useTicker = ko_models.ticker.ticker[0];
    	usdSelected = "selected";
    	
    }else if(model.currency === 'eur'){
    	useTicker = ko_models.ticker.ticker[1];
    	eurSelected = "selected";
    	ds = "&euro;";
    }
    
    
    //addMessage(model);

    var b = useTicker, //This defaults to USD. Eur will be in ticker[1]
	    myB = b,
	    id = myB.id;  //not actually used
	

	str = "";
	str += "              <table class='tickerTable'>\n";
	str += "                <tr>\n";
	
	
	str += "                  <th rowspan='2' id='exchangeTh" + id + "' class='tickerDescription'>Bitstamp<br>\n" +
	       "                    <select onchange='mo.setCurrency()' class='currencyToggle' id='currencyToggle'>"+
	       
	       
	       "                      <option value='usd' " + usdSelected + ">USD</option>" +
	       "                      <option value='eur' " + eurSelected + ">EUR</option>" +
	       
	       
	       "                    </select>" +
	       "                  </th>";
	       
	       
	str += "                  <th class='tickerHeader'>Last</th>\n";
	str += "                  <th class='tickerHeader'>Previous</th>\n";
	str += "                  <th class='tickerHeader'>Volume</th>\n";
	str += "                  <th class='tickerHeader'>High</th>\n";
	str += "                  <th class='tickerHeader'>Low</th>\n";
	str += "                  <th class='tickerHeader'>Bid</th>\n";
	str += "                  <th class='tickerHeader'>Ask</th>\n";
	str += "                  <th class='tickerHeader'>Trend</th>\n";
	str += "                </tr>\n";
	str += "                <tr>\n";
	str += "                  <td>" + ds + myB.last + "</td>\n";
	str += "                  <td>" + ds + myB.previous + "</td>\n";
	str += "                  <td>" + myB.volume + "</td>\n";
	str += "                  <td>" + ds + myB.high + "</td>\n";
	str += "                  <td>" + ds  + myB.low + "</td>\n";
	str += "                  <td>" + ds  + myB.bid + "</td>\n";
	str += "                  <td>" + ds  + myB.ask + "</td>\n";
	
	var trend = "Rising";
	if(myB.trend < 0) trend = "Falling";
	if(myB.trend == 0) trend = "Even";
	
	str += "                  <td>" + trend + "</td>\n";
	str += "                </tr>\n";
	str += "              </table>\n";
	
	return str;
}