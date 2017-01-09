/*
 * Modobot Main function
 */

var mo = {
	
	botTimer: null,
	tickerTimer: null,
	
	
	//Single asynch function call for everything. Takes a request object.
	asynch: function(request) {
	
		var typeFlag = request.type;

            $.ajax({
                    type : typeFlag,
                    url : request.url,
                    success : request.success,
                    error : request.failure,
                    data : request.data,
                    dataType : "json",
                    statusCode : {
                            404 : function(xhr, type, exception) {
                                    console.log("404 error");
                            },
                            400 : function(xhr, type, exception) {
                                    console.log("400 error");
                            },
                            410 : function(xhr, type, exception) {
                                    console.log("410 error");
                            },
                            500 : function(xhr, type, exception) {
                                    console.log("500 error");
                            }
                    }
            }).always(function() {
            });
	},
	
	requestObject: function(url, type, success, failure, data) {
		this.url = url;
		this.type = type; //"GET" or "POST"
		this.success = success; //success callback
		this.failure = failure;  //success failure
		this.data = data; //data or NULL
	},
	
	
	submitLogIn: function(){
		
		var data = {
				  uname: document.getElementById("banner_uname").value,
				  upass: document.getElementById("banner_upass").value
				},
		    url = "account";
		    if(data.uname != "" && data.upass != ""){
		    	var request = new mo.requestObject(url, "POST", ca.loginSuccess, ca.loginFailure, data);
		    	mo.asynch(request);
		    }else{
		    	li.alertModal("Invalid Credentials");
		    }
	
	},
	
	getBotState: function(){//show the modal
		
		
		var data = {session: model.session, token: model.token},
		    url = "state",
		    request = new mo.requestObject(url, "POST", ca.getBotStateSuccess, ca.getBotStateFailure, data);
		    
		mo.asynch(request);
		
	},
	
	getMessages: function(){
		
		var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "messages",
		    request = new mo.requestObject(url, "POST", ca.getMessagesSuccess, ca.getMessagesFailure, data);
		    
		mo.asynch(request);
	},

    getBotHistory: function(){
    	
    	var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
		    url = "history",
		    request = new mo.requestObject(url, "POST", ca.getHistorySuccess, ca.getHistoryFailure, data);
		    
		mo.asynch(request);
    },
    
    getTicker: function(){
    	var data = {id: 1}, //bitstamp id
		    url = "ticker",
		    request = new mo.requestObject(url, "GET", ca.getTickerSuccess, ca.getTickerFailure, data);
		    
		mo.asynch(request);
    },
    
    setUpdateTimers: function(){
    	
    	if( mo.tickerTimer === null){
	    	mo.tickerTimer = setInterval(function(){
	    		mo.getBotState(); 
	    	}, 60000);
	    }
    },
    
    updateMargins: function(){
    	
    	var base = $("#base").val().replace(/[^\d.]/g,""),
    	    increase = $("#increase").val().replace(/[^\d.]/g,""),
    	    decrease = $("#decrease").val().replace(/[^\d.]/g,""),
    	    ds = "$";
    	    
    	if(model.currency == "eur"){
    		ds = "&euro;";
    	}
    	    
    	$("#base").val(base);
    	$("#increase").val(increase);
    	$("#decrease").val(decrease);    
    	
    	base = base.replace("$", "");
    	//base = base*100;
    	increase = increase/100;
    	decrease = decrease/100;

   		
    	
    	$("#marginSalePrice").html( ds + ( base * (1 + increase) ).toFixed(2) );
    	$("#marginPurchasePrice").html( ds + ( base * (1 - decrease) ).toFixed(2) );
    },
    
    //log to status window in main view
    log: function(message){
    	$("#statusLogContent").append(message + "<br>");
    },
    
    //Polls configuration form to determine if data needs to be saved. Dirty
    //flag gets set when a config is changed.
    pollDirty: function(){
    	
    	setInterval(function(){
    		
    		if(mo.dirtyFlag){
    			li.updateConfigs();
    		}
    	}, 4000);
    	
    },
    
    /******* STRIPE RELATED CONTENT ********/
    submitOrder: function(){
        
        var $form = $('#payment-form');
    
        $form.submit(function(event) {
        	
	      // Disable the submit button to prevent repeated clicks:
	      event.preventDefault();
	      $form.find('.submit').prop('disabled', true);
	
	      // Request a token from Stripe:
	      Stripe.card.createToken($form, mo.stripeResponseHandler);
	
	      // Prevent the form from being submitted:
          return false;
        });
        
 
    },
    
    stripeResponseHandler: function(status, response) {
        // Grab the form:
	    var $form = $('#payment-form'),
	        owner = model.token; 
	
	    if (response.error) { 
	
	      // Show the errors on the form:
	      $form.find('.payment-errors').text(response.error.message);
	      $form.find('.submit').prop('disabled', false); // Re-enable submission
	
	    } else { // Token was created!
	
	      // Get the token ID:
	      var stripeToken = response.id;
	
	      var data = {
	          stripeToken: stripeToken,
	          owner: owner
	      };
	      
	      mo.submitBillable(data);
	      

	    }
	},
	
	submitBillable: function(data){
	    
	    //delete the record
	    var record = new su.requestObject('billable', 'POST', mo.billableSuccess, mo.billableFailure, data);
	    mo.asynch(record);
	},
	
	billableSuccess: function(data){
	    
	    if(data.status === 1){
	        alert("Account has been upgraded.");
	        
	        //change out the content
	        $("#activateAccount").html( $("#cancelSubscriptionTemplate").html() );

	    }else{
	        alert("Unable to complete your subscription.");
	    }
	
	},
	
	billableFailure: function(){},
	
	cancelSubscription: function(){
	    
	    var data = {
	          owner: model.token,
	          stripeToken : $("#_stripetoken").val()
	        };
	        
	    var record = new su.requestObject('cancelSubscription', 'POST', mo.cancelSubscriptionSuccess, mo.cancelSubscriptionFailure, data);
	    mo.asynch(record);
	},
	
	cancelSubscriptionSuccess: function(data){
	    
	    //console.log(data);
	    alert("Subscription has been cancelled.");
	    $("#activateAccount").html( $("#stripeOrder").html() );
	    model.paid = false;
	    
	},
	
	setCookie:function(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = cname + "=" + cvalue + "; " + expires;
	},
	
	getCookie: function(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i = 0; i < ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	},
	
	setCurrency: function(){
		
		var currency = $(".currencyToggle option:selected").val(),
		    tickerHmtl = "";
		
		mo.setCookie("modoData", JSON.stringify({'currency':currency}), 365);
		model.currency = currency;
		
		$("#tickerContainer").html(buildTickerView());
		
		mo.dirtyFlag = true;
	},
};

/* Ready, go */
$(function() {
	
    //ko.applyBindings(ko_models.loginForm);
    li.initLogin();
    
    //apply bindings to the model here.
    ko.applyBindings(ko_models);
    
    //$( "#mail" ).draggable();
    li.confighandle();
    li.accounthandle();
    li.reviewshandle();
    li.privacyhandle();
    
    //only setting cookies here for testing purposes.s
    //mo.setCookie("modoData", JSON.stringify({'currency':'eur'}), 365);
});

/* POLYFILL */
/*
 * This was added because some browsers didn't recognize the template tag
 */

(function templatePolyfill(d) {
    if('content' in d.createElement('template')) {
        return false;
    }

    var qPlates = d.getElementsByTagName('template'),
        plateLen = qPlates.length,
        elPlate,
        qContent,
        contentLen,
        docContent;

    for(var x=0; x<plateLen; ++x) {
        elPlate = qPlates[x];
        qContent = elPlate.childNodes;
        contentLen = qContent.length;
        docContent = d.createDocumentFragment();

        while(qContent[0]) {
            docContent.appendChild(qContent[0]);
        }

        elPlate.content = docContent;
    }
})(document);




