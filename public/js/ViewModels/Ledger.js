
var buildLedgerView = function()
{
  //this will need to eventually be passed an id.

  // manually handle which bot gets processed.
  var b = ko_models.bot.bot[0],
      myB = b,
      id = myB.id;

  
  str = "";
  str += "  <div class='sectionHeader'>Balances:</div>\n";
  str += "  <table class='balanceTable'>";
  str += "    <tr>";
  str += "      <th>USD: </th><td id='availableUsd" + id + "'>$" + myB.usd + "</td>"; 
  str += "      <th>BTC: </th><td id='availableBtc" + id + "'>" + myB.btc + "</td>";
  str += "      <th>REMAINING TRADES: </th><td id='availableTrades" + id + "'>" + myB.trades + "</td>";
  //str += "      <th>Purchase Price: </th><td id='ppp" + id + "'>$" + myB.ppp + "</td>";
  //str += "      <th>Sell Price: </th><td id='spp" + id + "'>$" + myB.spp + "</td>";
  str += "    </tr>";
  str += "  </table>";
  str += "</div>";
  
  return str;
};

  

