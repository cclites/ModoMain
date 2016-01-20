function buildTickerView()
{

    //console.log( JSON.stringify(ko_models.bot) );
    
    console.log(Object.keys(ko_models.ticker.ticker[0]));
    console.log(ko_models.ticker.ticker[0].direction);
    
    //return;

    //addMessage(model);

    var b = ko_models.ticker.ticker[0],
	    myB = b,
	    id = myB.id;  //not actually used
	


	str = "";
	str += "              <table class='tickerTable'>\n";
	str += "                <tr>\n";
	str += "                  <th rowspan='2' id='exchangeTh" + id + "' class='tickerDescription'>Bitstamp</th>\n";
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
	str += "                  <td>$" + myB.last + "</td>\n";
	str += "                  <td>$" + myB.previous + "</td>\n";
	str += "                  <td>" + myB.volume + "</td>\n";
	str += "                  <td>$" + myB.high + "</td>\n";
	str += "                  <td>$" + myB.low + "</td>\n";
	str += "                  <td>$" + myB.bid + "</td>\n";
	str += "                  <td>$" + myB.ask + "</td>\n";
	
	var trend = "Rising";
	if(myB.direction == -1) trend = "Falling";
	if(myB.direction == 0) trend = "Even";
	
	str += "                  <td>" + trend + "</td>\n";
	str += "                </tr>\n";
	str += "              </table>\n";
	
	return str;
}