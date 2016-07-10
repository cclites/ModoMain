var su = {
    
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
            this.type = type;
            this.success = success;
            this.failure = failure;
            this.data = data;
            
            return this;
    },
    
};





