/*
 * Code for in page caluclator that calculates price points
 * 
 * For calcualtions, it takes the user provided base point, percent increase, and percent 
 * decrease to determine and display price points in the view.
 */


var calculateSpread = function()
{
    var myBot = ko_models.bot.bot[0],
		base = document.getElementById("base").value,
		increase = document.getElementById("increase").value,
		decrease = document.getElementById("decrease").value,
		fee = 0, //no fee is acounted for
		spp = ppp = base,
		sellspread, sellfee, buyspread, buyfee;
	
	if (decrease > 0)
	{
		ppp = Number(base) - (  Number(base) * ( Number(decrease)/100));
	}
	else
	{
		ppp = Number(base);
	}
	
	if ( increase > 0)
	{
		spp = (Number(base) + (Number(base) * (Number(increase)/100)));
		//addMessage("new spp = " + spp);
	}
	else
	{
		spp = Number(base);
	}
	
	spp=spp.toFixed(2);
	ppp=ppp.toFixed(2);
	
	$("#newPpp").html("$" + ppp);
	$("#newSpp").html("$" + spp);
	
	sellfee = buyfee = fee;
	
	sellspread = (spp-base - sellfee).toFixed(8);
	buyspread = (base - ppp - buyfee).toFixed(8);
	
	if(sellspread <= 0)
	{
		$("#sellSpread").removeClass("noError");
		$("#sellSpread").addClass("error");
	}
	else
	{
		$("#sellSpread").removeClass("noError");
		$("#sellSpread").addClass("noError");
	}
	
	if(buyspread <= 0)
	{
		$("#buySpread").removeClass("noError");
		$("#buySpread").addClass("error");
	}
	else
	{
		$("#buySpread").removeClass("noError");
		$("#buySpread").addClass("noError");
	}
	
	$("#sellSpread").text(sellspread);
	$("#buySpread").text(buyspread);	
	
	actualSellSpread = (sellspread - sellfee).toFixed(8);
	actualBuySpread = (buyspread - buyfee).toFixed(8);
	
	$("#actualSellSpread").text(actualSellSpread);
	$("#actualBuySpread").text(actualBuySpread);
};