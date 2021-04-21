<?php
require_once(__DIR__.'/config.php');
// Get No Of argument
$argument = str_replace(ProjectFolder,"",$_SERVER['REQUEST_URI']) ;
$exp = explode("/",$argument);
$arg = array_values(array_filter($exp));

global $calling_controller;
global $calling_method ;
//echo count( $exp );
//pr( $exp ); 
if(count($exp) == 2 && $exp[1]==''){
	$calling_controller =  DEFAULTCONTROLLER;
	$calling_method =  !empty($arg[0])?$arg[0]:'index';
}else{
	$calling_controller =  $arg[0];
	$calling_method =  isset($arg[1])?$arg[1]:'index';
}

if( $calling_method == ""){ $calling_method = 'index';}

unset( $arg[0] );
unset( $arg[1] );
$arg = implode("/", array_values($arg));
