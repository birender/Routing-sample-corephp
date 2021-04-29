<?php
class CategoryDb extends DBConfig {   
    public $conn;   
    public function __construct() {
        $this->conn = parent::__construct();
        $this->conn->setPrefix(_DB_PREFIX);
    }

    public function GetHomeCategories() { 
        //$this->conn->where("display_on_homepage", "yes");        
        $categories = $this->conn->get('country');
        //echo $this->conn->getLastQuery();
        return $categories;
    }
}
