var mo = {
	
	botTimer: null,
	tickerTimer: null,
	
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
		})/*.error(function(xhr, type, exception) {
			console.log("Asynch error\n");
			console.log(xhr);
		})*/;
	},
	
	requestObject: function(url, type, success, failure, data) {
		this.url = url;
		this.type = type;
		this.success = success;
		this.failure = failure;
		this.data = data;
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
    	    decrease = $("#decrease").val().replace(/[^\d.]/g,"");
    	    
    	$("#base").val(base);
    	$("#increase").val(increase);
    	$("#decrease").val(decrease);    
    	
    	base = base.replace("$", "");
    	//base = base*100;
    	increase = increase/100;
    	decrease = decrease/100;

   		
    	
    	$("#marginSalePrice").html( "$" + ( base * (1 + increase) ).toFixed(2) );
    	$("#marginPurchasePrice").html( "$" + ( base * (1 - decrease) ).toFixed(2) );
    },
    
    log: function(message){
    	$("#statusLogContent").append(message + "\n");
    	
    	console.log(message);
    },
    
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
	        owner = model.token; //do not believe that I have an email here, do I?
	                                    //Should be able to embed it on the backside, right?
	                                    //Clearly I have some info that is important
	
	    if (response.error) { // Problem!
	
	      // Show the errors on the form:
	      $form.find('.payment-errors').text(response.error.message);
	      $form.find('.submit').prop('disabled', false); // Re-enable submission
	
	    } else { // Token was created!
	
	      // Get the token ID:
	      var stripeToken = response.id;
	
	      // Insert the token ID into the form so it gets submitted to the server:
	      //$form.append($('<input type="hidden" name="stripeToken">').val(token));
	      
	      //console.log("Token is " + token);
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
	    su.asynch(record);
	},
	
	billableSuccess: function(data){
	    
	    if(data.status === 1){
	        alert("Account has been upgraded.");
	        
	        //change out the content
	        
	        $("#activateAccount").html( $("#cancelSubscriptionTemplate").html() );
	        
	        //location.reload();
	    }else{
	        alert("Unable to complete your subscription.");
	        //location.reload();
	    }
	
	},
	
	billableFailure: function(){},
	
	cancelSubscription: function(){
	    
	    var data = {
	          owner: model.token,
	          stripeToken : $("#_stripetoken").val()
	        };
	        
	    var record = new su.requestObject('cancelSubscription', 'POST', mo.cancelSubscriptionSuccess, mo.cancelSubscriptionFailure, data);
	    su.asynch(record);
	},
	
	cancelSubscriptionSuccess: function(data){
	    
	    //console.log(data);
	    alert("Subscription has been cancelled.");
	    $("#activateAccount").html( $("#stripeOrder").html() );
	    model.paid = false;
	    
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
    

    
});




