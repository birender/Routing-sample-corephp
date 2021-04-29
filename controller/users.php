<?php

class Users extends Config {
	
	public function index(){
		echo "Calling Users Index Function";
	}
	
	public function demo($data = array()){ 	
		//$this->cache(1);
		render('common/header',$data,['title'=>'User Project']);
		render('userlist',$data);
		render('common/footer',$data);
		//$this->cache(2);
	}
	
	public function second($data = array()){
		echo "Calling Users Second Function";
	}
	
	public function display(){
		//echo "Calling Users Second Function" ;
		echo json_encode(array("ajax"=>"Ajax Calling"));
	}
}
 