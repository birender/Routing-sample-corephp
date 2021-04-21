<?php

class Users {
	
	public function index(){
		echo "Calling Users Index Function";
	}
	
	public function demo($data = array()){ 
		
		render('userlist',$data);
	}
	
	public function second($data = array()){
		echo "Calling Users Second Function";
	}
}
 