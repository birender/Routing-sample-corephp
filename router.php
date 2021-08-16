<?php

function get($route, $path_to_include,$argument=''){
  if( $_SERVER['REQUEST_METHOD'] == 'GET' ){ route($route, $path_to_include,$argument); }  
}
function post($route, $path_to_include,$argument=''){
  if( $_SERVER['REQUEST_METHOD'] == 'POST' ){ route($route, $path_to_include,$argument); }    
}
 
function any($route, $path_to_include){ route($route, $path_to_include); }

function route($route, $path_to_include,$argument=''){ 
  if($route == "/404"){    
    http_response_code(404);
    include_once("{$_SERVER['DOCUMENT_ROOT']}/$path_to_include");
    exit();
  }  

  global $calling_controller;	
  global $calling_method;	
  
  $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
  $request_url = rtrim($request_url, '/');
  $request_url = strtok($request_url, '?');
 
  $route_parts = explode('/', $route);
  $request_url_parts = explode('/', $request_url);
 
  $request_url = str_replace(ProjectFolder,"",$_SERVER['REQUEST_URI']) ;
  $request_url = $request_url;
   
  $parameters = [];
  $path = explode("/",$path_to_include);
  $controller = '';
  $method = ''; 
  if( !empty($path) ){ 
	  if( count($path) >1 ){  
			$controller = $calling_controller;
			$method	= $calling_method;
			spl_autoload_register(function ($controller) {
				include 'controller/'.$controller . '.php';
			});
			$obj  = new $controller(); 
			$argument = array_values($argument);
			
			if( !is_array( $argument ) ){
				if( $argument !="" ){
					$argument = explode("/",$argument);
				} 
			}
			
			if( !empty( $route_parts ) ){
				if( $route_parts[0] == "" && $route_parts[1] == $controller){
					$method = $route_parts[2];
					$obj->$method($argument);
				}else{
					$obj->$method($argument);
				}
			}else{
				$obj->$method($argument);
			}
	  }else{
		  // Calling Default Controller Index Method		 
		  $controller 	= $calling_controller;
		  $method		= $calling_method;
		  spl_autoload_register(function ($controller) {
				include 'controller/'.$controller . '.php';
		  });
		  $obj  = new $controller();
		  $obj->$method($argument);
	  }
  }
}

function out($text){echo htmlspecialchars($text);}
function set_csrf(){
  $csrf_token = bin2hex(openssl_random_pseudo_bytes(30));
  $_SESSION['csrf'] = $csrf_token;
  echo '<input type="hidden" id="csrf_token" name="csrf_token" value="'.$csrf_token.'">';
}
function is_csrf_valid(){
  if( ! isset($_SESSION['csrf']) || ! isset($_POST['csrf'])){ return false; }
  if( $_SESSION['csrf'] != $_POST['csrf']){ return false; }
  return true;
}

function render($location = '', $data = array(), $page_meta = array(), $return_type = FALSE) {
    if ($return_type == TRUE) {
        ob_start();
        include_once("views/$location.php");
        $content = ob_get_contents();
        @ob_end_clean();
        ob_end_flush();
        return $content;
    } else { 
        if( $location == '404'){
           header("HTTP/1.1 404 Not Found");
        }
        include_once("views/$location.php");
    }
}
