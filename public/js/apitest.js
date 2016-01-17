function asynch(request) {
	
	var typeFlag = request.type;

	$.ajax({
		type : typeFlag,
		url : request.url,
		success : request.success,
		error : request.failure,
		data : request.data,
		dataType: "json",
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
}

function requestObject(url, type, success, failure, data) {
	this.url = url;
	this.type = type;
	this.success = success;
	this.failure = failure;
	this.data = data;
}

/**********************************************************************
 * CALLBACKS 
 *********************************************************************/

var callback = {

	testInvalidLoginSuccess : function(data) {
		
		if(data.status == false){
			$("body").append("PASS: Invalid Login<br>");
		}else{
			$("body").append("FAIL: Invalid Login<br>");
		}
	},
	
	testInvalidLoginFailure : function(xhr, type, exception) {
		
		console.log("FAILED ***************\n");
		
		console.log(xhr.responseText);
		$("body").append(xhr.responseText);
	},
	
	testValidLoginSuccess : function(data) { 
		
        if(data.status != false){
			$("body").append("PASS: Valid Login<br>");
			model.token = data.token;
			model.session = data.session;
		}else{
			$("body").append("FAIL: Valid Login<br>");
		}
    },
	
	testValidLoginFailure : function(xhr, type, exception) {},
	
	testGetBotStateSuccess: function(data){
		
		console.log(data);
		
		if(data.bot == 0){
			$("body").append("FAIL: Valid State<br>");
		}else{
			
			//need to save bot id and owner id
			model.id = data.bot[0].id;
			model.owner_id = data.bot[0].owner_id;
			
			$("body").append("PASS: Valid State<br>");
		}
	},
	
	testGetBotStateFailure : function(xhr, type, exception) {},
	
	testGetTickerSuccess: function(data){
		if(data.ticker.length){
			$("body").append("PASS: Valid Ticker<br>");
		}else{
			$("body").append("FAIL: Valid Ticker<br>");
		}
	},
	
	testGetTickerFailure: function(xhr, type, exception){},
	
	testGetHistorySuccess: function(data){
		console.log(data);
	},
	testGetHistoryFailure: function(xhr, type, exception){},
};

/**********************************************************************
 * TESTS 
 *********************************************************************/

function testInvalidLogin() {
	
	var data = {uname : "sundance", upass : "123456"},
        url = "http://localhost/ModoMain/public/account";
	
	$request = new requestObject(url, "POST", callback.testInvalidLoginSuccess, callback.testInvalidLoginFailure, data);
	asynch($request);

}

function testValidLogin() {

    var data = {uname : "ModoBot", upass : "modobot_demo"},
        url = "http://localhost/ModoMain/public/account";

	$request = new requestObject(url, "POST", callback.testValidLoginSuccess, callback.testValidLoginFailure, data);
	asynch($request);
}

function testGetBotState(){
	var data = {session: model.session, token: model.token},
	    url = "http://localhost/ModoMain/public/state";
	    
	$request = new requestObject(url, "POST", callback.testGetBotStateSuccess, callback.testGetBotStateFailure, data);
	asynch($request);
}

function testGetTicker(){
	
	var data = {id: 1}, //bitstamp id
	    url = "http://localhost/ModoMain/public/ticker";
	    
	$request = new requestObject(url, "GET", callback.testGetTickerSuccess, callback.testGetTickerFailure, data);
	asynch($request);
	
}

function testGetHistory(){
	var data = {session: model.session, token: model.token, id: model.id, owner_id: model.owner_id},
	    url = "http://localhost/ModoMain/public/history";
	    
	$request = new requestObject(url, "POST", callback.testGetHistorySuccess, callback.testGetHistoryFailure, data);
	asynch($request);
}

/*********************************************************************
 * MODEL
 ********************************************************************/
var model = {
	session: "",
	token: "",
	id: "",
	owner_id: "",
};

$(function() {

	testValidLogin();
	testInvalidLogin();
	
	setTimeout(function(){
		
		if(model.session !== ""){
			testGetBotState();
		}
		    	
	}, 1000);
	
	setTimeout(function(){
		
		if(model.session !== ""){
			testGetHistory();
		}
		    	
	}, 2000);
	
	testGetTicker();

});