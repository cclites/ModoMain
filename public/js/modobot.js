var mo = {
	
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
		}).error(function(xhr, type, exception) {
			console.log("Asynch error\n");
			console.log(exception);
		});
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
		    url = "account",
	        request = new mo.requestObject(url, "POST", ca.loginSuccess, ca.loginFailure, data);
	        
		mo.asynch(request);
	
	},
	
	getBotState: function(){
		
		var data = {session: model.session, token: model.token},
		    url = "state",
		    request = new mo.requestObject(url, "POST", ca.getBotStateSuccess, ca.getBotStateFailure, data);
		    
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
    }
};

/* Ready, go */
$(function() {
	
    //ko.applyBindings(ko_models.loginForm);
    li.initLogin();
    
});

