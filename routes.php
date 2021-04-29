<?php
require_once(__DIR__.'/router.php');
require_once(__DIR__.'/system/uri.php');
require_once(__DIR__.'/system/require.php');
 
//load_library(); Include All Library
//load_helper();  Include All Helper Method

switch($calling_controller){
	case 'welcome':
		switch($calling_method)
		{
			case 'index':
				get("/","index");
			break;
			case 'first':
				get("/welcome/demo", "welcome/first",$arg);	
			break;
		}
	break;	
	
	case 'users':	
		 
		switch($calling_method)
		{
			case 'index':
				get("users/index","index");
			break;
			case 'second':
				get("/users/demo", "users/second",$calling_method);	
			break;
			
			default:
				get("/users/demo", "users/$calling_method",$calling_method);	
			break;
		}
	break;

	case 'category':	
		 
		switch($calling_method)
		{
			case 'index':
				get("users/index","index");
			break;
			
			default:
				get("/category/getcategory", "category/$calling_method",$calling_method);	
			break;
		}
	break;
	
	default:
		http_response_code(404);
		include_once("views/404.php");
	break;	
}
 