<?php
error_reporting(E_ALL);
require_once(__DIR__.'/MysqliDb.php');
define('ProjectFolder' , "/main-main");// Only for Local
define('DEFAULTCONTROLLER','welcome');
date_default_timezone_set('America/Los_Angeles');

function pr($data,$status=0){
	echo "<pre>";
	print_r($data);
	echo "========================================<br/></pre>";
	if( $status == 0 ){
		exit(0);
	}
}

class Config{
	private $HOST 		= "LOCALHOST";
	private $USERNAME 	= "root";
	private $PASSWORD 	= "";
	private $DATABASE 	= "curd";	
	
	public function __construct(){
		return new MysqliDb($this->HOST,$this->USERNAME,$this->PASSWORD,$this->DATABASE);
	}
}/* End of Config Class */  