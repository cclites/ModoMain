var calculateSpread = function()
{
    var myBot = ko_models.bot.bot[0],
		base = document.getElementById("base").value,
		increase = document.getElementById("increase").value,
		decrease = document.getElementById("decrease").value,
		//configs = myBot.configs,  //<-- No. That object does not exist
		//ledger = myBot.ledger, //No. That object does not exist.
		//fee = (myBot.exchange_fee()*2),
		//TODO: remove hard coded fee
		fee = 0,
		spp = ppp = base,
		sellspread, sellfee, buyspread, buyfee;

    /*
	addMessage("\n\n");
	addMessage("base is " + base);
	addMessage("Increase is " + increase);
	addMessage("decrease is " + decrease);
	addMessage("Fee is " + fee);
	addMessage("Adjusted fee is " + fee);
	addMessage("Adjusted increase is " + (increase/100));
	addMessage("Adjusted decrease is " + (decrease/100));
	*/
	
	
	if (decrease > 0)
	{
		ppp = Number(base) - (  Number(base) * ( Number(decrease)/100));
		//addMessage("new ppp = " + ppp);
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
	
	//sellfee = ((spp*fee)/100).toFixed(2);
	//buyfee = ((ppp*fee)/100).toFixed(2);
	
	//sellfee = ( (spp) ).toFixed(2);
	//buyfee = ( (ppp) ).toFixed(2);
	sellfee = buyfee = fee;
	
	//$("#sellFee").html(sellfee);
	//$("#buyFee").html(buyfee);
	
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

/*
function splashPageCalculator()
{
	var base = document.getElementById("base").value,
		increase = document.getElementById("increase").value,
		decrease = document.getElementById("decrease").value,
		//configs = myBot.configs,
		//ledger = myBot.ledger,
		fee = document.getElementById("fee").value,
		spp = ppp = base,
		sellspread, sellfee, buyspread, buyfee;
	
	addMessage("\n\n");
	addMessage("base is " + base);
	addMessage("Increase is " + increase);
	addMessage("decrease is " + decrease);
	addMessage("Fee is " + fee);
	addMessage("Adjusted fee is " + fee);
	

	if (decrease > 0)
	{
		ppp = Number(base) - (  Number(base) * ( Number(decrease)/100));
		//addMessage("new ppp = " + ppp);
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
	
	$("#ppp").val(ppp);
	$("#spp").val(spp);
	
	sellfee = ((spp*fee)/100).toFixed(2);
	buyfee = ((ppp*fee)/100).toFixed(2);
	
	$("#sellfee").val(sellfee);
	$("#buyfee").val(buyfee);
	
	sellspread = (spp - base).toFixed(2);
	buyspread = (base - ppp).toFixed(2);
	
	//addMessage("sellspread is " + sellspread);
	//addMessage("buyspread is " + buyspread);
	
	if(sellspread <= 0)
	{
		$("#sellspread").removeClass("noError");
		$("#sellspread").addClass("error");
	}
	else
	{
		$("#sellspread").removeClass("noError");
		$("#sellspread").addClass("noError");
	}
	
	if(buyspread <= 0)
	{
		$("#buyspread").removeClass("noError");
		$("#buyspread").addClass("error");
	}
	else
	{
		$("#buyspread").removeClass("noError");
		$("#buyspread").addClass("noError");
	}
	
	//$("#sellspread").text(sellspread);
	//$("#buyspread").text(buyspread);	
	
	
	actualSellSpread = (sellspread - sellfee).toFixed(2);
	actualBuySpread = (buyspread - buyfee).toFixed(2);
	
	$("#sellspread").val(actualSellSpread);
	$("#buyspread").val(actualBuySpread);
	
}
*/