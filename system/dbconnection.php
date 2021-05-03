<?php 
error_reporting(E_ALL);
require_once(__DIR__ . '/MysqliDb.php');

/**
 * [Database Class DBConfig]
 */
class DBConfig {
    /**
     * @var HOST
     */
    private $HOST = "10.16.70.70";
    /**
     * @var USERNAME
     */
    private $USERNAME = "root";
    /**
     * @var PASSWORD
     */
    private $PASSWORD = "123456789aa";
    /**
     * @var DATABASE
     */
    private $DATABASE = "ab_test";
   
    /**
     * Constructor To SetUp Database connection
     */
    public function __construct() {  
        return new MysqliDb($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASE);
    }/* End of Method */
}/* End of Class */