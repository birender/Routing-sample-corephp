/*
	Date 		: 23 Aprill 2021
	Description : Common JS Method
	Company		: Bamko.net
*/

// Common Method For Ajax Call
function callAjax(wwwroot,data={},methodType='POST',dataType='json',asyncType = false){
	let RESULT,STATUSCODE,RESPONCE;
	$.ajax({
		  'url': wwwroot,
		  'async': asyncType,
		  'type': methodType,
		  'dataType': dataType,
		  'data':data,
		  success: function (data,status,xhr){  
			  RESULT 		= data;
			  STATUSCODE 	= status;
			  RESPONCE 		= xhr;
		  },error(xhr,status,error){
			  RESULT 		= {};
			  STATUSCODE 	= status;
			  RESPONCE 		= xhr;
			  return {status:status,responseText:xhr.responseText};
		  },beforeSend(xhr){
			  console.log( "Ajax Initilize");
		  }
	});
	if( STATUSCODE == 'success' ){
		return RESULT;//{statuscode:STATUSCODE,responce:RESULT} ;
	}else{
		return RESPONCE ;
	}
} /* End of Method */

// Include JS File
function includeJS(file,type='head') {
  let script   = document.createElement('script');
  script.src   = ASSETS+file;
  script.type  = 'text/javascript';
  script.defer = true;
  document.getElementsByTagName(type).item(0).appendChild(script);
}/* End of Method */

//Refresh Captcha

function refreshCaptcha(){
    var img = document.images['captcha_image'];
    img.src = img.src.substring(WWWROOT+"captcha/rand/"+Math.random()*1000);
}