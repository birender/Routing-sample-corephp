<?php

// Extends Config File To Load DB Object

class Welcome extends Config {
	public function __construct(){
		 $this->loadmodel(array('category_db'));
	}
	
	public function index(){
		$data = array();
        $catObj = new CategoryDb();
        $data['result'] = $catObj->GetHomeCategories();
		pr( $data['result']);
	}
	
	public function demo($data){ 
		render('common/header',$data);
		render('userlist',$data);
		render('common/footer',$data);
	}
	
	public function second($data = array()){
		echo "Calling Second Function";
	}
}
 