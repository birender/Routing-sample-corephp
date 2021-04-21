<?php

// Extends Config File To Load DB Object

class Welcome extends Config {
	public $conn;
	public function __construct(){
		$this->conn = parent::__construct();
	}
	
	public function index(){
		echo "Calling Index Function";
	}
	
	public function demo($data){ 
		render('userlist',$data);
	}
	
	public function second($data = array()){
		echo "Calling Second Function";
	}
}
 