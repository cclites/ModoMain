
//There is no model when this is first loaded. Binding has to happen once the bot configuration is loaded.
//var configs = new ko.observableArray(model[0].configs);

/*
var updateConfigs = function(id)
{
	var url = 'Api/Dispatcher.php',
	    uToken = model.token(),
	    uSession = "",
	    keys = {token: uToken, session: uSession},
	    bots = model.bots(),
	    myBot = bots[0],
		//configs = ko.mapping.toJSON(myBot.configs),  //TODO: Map this properly.
		//base = myBot.ledger.base();		//model is not yet properly bound, so get()
		                                    //need to get base manually.
											
											
		base = document.getElementById("base" + id).value, 
		isActive = document.getElementById("isActive" + id).checked, 
		testingMode = document.getElementById("isTesting" + id).checked, 
		buying = document.getElementById("isBuying" + id).checked, 
		selling = document.getElementById("isSelling" + id).checked, 
		increase = document.getElementById("increase" + id).value, 
		sellLimitBtc = document.getElementById("sellLimitBtc" + id).value, 
		decrease = document.getElementById("decrease" + id).value, 
		buyLimitBtc = document.getElementById("buyLimitBtc" + id).value;
		fixed_sell = document.getElementById("fixed_sell" + id).checked;
		fixed_buy = document.getElementById("fixed_buy" + id).checked;
		fixed_sell_amount = document.getElementById("fixed_sell_amount" + id).value;
		fixed_buy_amount = document.getElementById("fixed_buy_amount" + id).value;
		
	//addMessage("Is active = " + isActive);
		
		
	// Hand roll a config object
	var configs = 
	{
		is_active: isActive,
		testing_mode: testingMode,
		buying: buying,
		selling: selling,
		increase: increase,
		decrease: decrease,
		sell_limit_btc: sellLimitBtc,
		buy_limit_btc: buyLimitBtc,
		fixed_sell: fixed_sell,
		fixed_buy: fixed_buy,
		fixed_sell_amount: fixed_sell_amount,
		fixed_buy_amount: fixed_buy_amount
	}
	
	//alert(configs);
											

	$.ajax({
		type: "POST",
		url: url,
	    data: { func:"updateConfigs", args: keys, id: id, configs: configs, base:base }
		}).success(function(data){
		
        //addMessage(data);
		
		addMessage("Configurations have been updated. Reloading Bot info.");	
		//getBot(true);
		}).fail(function(data, msg, error){
		   addMessage("Configuration failed to update.\n" + data + "\n" + msg + "\n" + error);
		});
}*/
