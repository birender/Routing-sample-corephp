var res = callAjax(WWWROOT+"/users/display",{"id":24,"name":"Sahil"});
$("#msg").html( res.ajax );
console.log( res.ajax );