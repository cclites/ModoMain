
var buildLedgerView = function()
{
  //this will need to eventually be passed an id.

  // manually handle which bot gets processed.
  var b = ko_models.bot.bot[0],
      myB = b,
      id = myB.id;

  
  str = "";
  str += "  <div class='sectionHeader'>Balances:</div>\n" +
         "  <table class='balanceTable'>" +
         "    <tr>" +
         "      <th>USD: </th><td id='availableUsd" + id + "'>$" + myB.usd + "</td>" + 
         "      <th>BTC: </th><td id='availableBtc" + id + "'>" + myB.btc + "</td>";
         
  if(model.paid == 1){
  	str += "      <th>Subscribed:</th><td id='availableTrades" + id + "'>Yes</td>";
  }else{
  	str += "      <th>Subscribed:</th><td id='availableTrades" + id + "'>Yes</td>";
  }
  
  //str += "      <th>REMAINING TRADES: </th><td id='availableTrades" + id + "'>" + myB.trades + "</td>";
  //str += "      <th>Purchase Price: </th><td id='ppp" + id + "'>$" + myB.ppp + "</td>";
  //str += "      <th>Sell Price: </th><td id='spp" + id + "'>$" + myB.spp + "</td>";
  str += "    </tr>" +
         "  </table>" +
         "</div>";
  
  return str;
};

  

