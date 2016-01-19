function buildHistoryView()
{
	//this will need to eventually be passed an id.
	
	//console.log(Object.keys(ko_models.history.history[0]));
	
	// manually handle which bot gets processed.
	var b = ko_models.history.history[0],
	    myB = b,
	    id = ko_models.bot.bot[0].id,
	    str = "";
	
	
	history["currency"] = "BTC";
	
	str += "    <div class='sectionHeader'>Historic Data:</div>\n";
	str += "               <table class='historyTable'>\n"; 
	str += "                   <tr>\n"; 
	str += "                       <th class='historylabel'>HIGH</th>\n"; 
	str += "                       <th class='historylabel'>LOW</th>\n";
	str += "                       <th class='historylabel'>DATE HIGH</th>\n";
	str += "                       <th class='historylabel'>DATE LOW</th>\n";
	str += "                       <th class='historylabel'>START USD</th>\n";
	str += "                       <th class='historylabel'>START BTC</th>\n";
	str += "                       <th class='historylabel'>CURRENCY</th>\n";
	str += "                  </tr>\n"; 
	str += "                <tr>\n";
	
	//var h = parseFloat(myB.high());
	//var l = parseFloat(myB.low());
	
	str += "                    <td>$"+ parseFloat(myB.high).toFixed(2) +"</td>\n"; 
	str += "                    <td>$"+ parseFloat(myB.low).toFixed(2) +"</td>\n"; 
	str += "                    <td>"+ (myB.date_high) +"</td>\n"; 
	str += "                    <td>"+ (myB.date_low) +"</td>\n"; 
	str += "                    <td>$"+ parseFloat(myB.start_usd).toFixed(2) +"</td>\n"; 
	str += "                    <td>"+ (myB.start_btc) +"</td>\n";
	str += "                    <td>"+ history["currency"] +"</td>\n";
	
	str += "                </tr>\n";
	str += "             </table>\n"; 
	
	return str;
	
}