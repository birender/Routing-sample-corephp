<?php
error_reporting(E_ALL);
ini_get('display_errors');
require_once(__DIR__ . '/dbconnection.php');

define('ProjectFolder' , "/main-main");// Only for Local 
define('DEFAULTCONTROLLER','welcome');
define('_DB_PREFIX', 'hpi_');
define('URL_ENCRYPTION_KEY','THE_QUICK_BROWN_FOX_JUMP_123456');
define('URL_ENCRYPTION_IV','OVER_THE_LAZY_DOG.');
date_default_timezone_set('America/Los_Angeles');

$protocal = ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1')?'http://':'https://';

define('WWWROOT',$protocal.$_SERVER['HTTP_HOST'].ProjectFolder);
define('ASSETS',$protocal.$_SERVER['HTTP_HOST'].ProjectFolder.'/assets/');
define('CACHE',$protocal.$_SERVER['HTTP_HOST'].ProjectFolder.'/cache/');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

function pr($data,$status=0){
	echo "<pre>";
	print_r($data);
	echo "========================================<br/></pre>";
	if( $status == 0 ){
		exit(0);
	}
}

/**
 * [Class Configuration]
 */
class Config{
	public $ip;
	public $browser;
    public static $PAGE_META = array();
	
	/**
     * Fetch IP and User Agent
	 */
	public function __construct(){
		$this->ip = $_SERVER['REMOTE_ADDR'];
        $this->browser = $_SERVER ['HTTP_USER_AGENT'];
        Config::$PAGE_META['title'] = 'Sample PHP Rounting';
	}/* End of Method */

    /**
     * @param mixed $page
     * 
     * @return [type]
     */
    public function page_meta($page){
        Config::$PAGE_META['title'] = $page;
    }
	
	/**
	 * @param mixed $type [type = 1 .. Include Cache Start ; type =2 .. Include Cache End ]
	 * 
	 * @return [type ]
	 */
	public function cache($type){ 
		if( $type == ""){ 
			return false;
		}
		if( $type == 1){ 
			require_once(__DIR__.'/cache_start.php');
		}else if( $type == 2 ){ 
			require_once(__DIR__.'/cache_end.php');
		}
	}/* End of Method */
	
	/**
	 * @param mixed $string
	 * 
	 * @return [type]
	 */
	public function encrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha512', URL_ENCRYPTION_KEY);
        $iv = substr(hash('sha512', URL_ENCRYPTION_IV), 20, 20);
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        return $output;
    }/* End of Method */
	
	/**
	 * @param mixed $string
	 * 
	 * @return [type]
	 */
	public function decrept($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha512', URL_ENCRYPTION_KEY);
        $iv = substr(hash('sha512', URL_ENCRYPTION_IV), 20, 20);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
	}/* End of Method */
	
	 /**
	  * @param mixed $modelName = array() // Dynamically Load Model
	  * 
	  * @return [type]
	  */
	 public function loadmodel($modelName = array()) {
        if (empty($modelName)) {
            return false;
        }
        foreach ($modelName as $name) {
            if (file_exists("db/$name.php")) {
                include_once("db/$name.php");
            } else {
                echo "Invalid Model Name : $name";die;
            }
        }
    }/* End of Method */

}/* End of Config Class */  
  
//set_error_handler("error_handler");
function error_handler($errno='E_USER_ERROR', $errstr, $errfile='error_log.txt', $errline)
{
    global $logfile_dir, $logfile, $logfile_delete_days;
    
    $logfile_dir = 'system/error_log';
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }

    $filename = basename($errfile);
    $logfile = 'system/error_log/error_log_'.date('Y_M_d').'.txt';

    switch ($errno) {
        case E_USER_ERROR:
            file_put_contents($logfile, date("y-m-d H:i:s.").gettimeofday()["usec"] . " $filename ($errline): " . "ERROR >> message = [$errno] $errstr\n", FILE_APPEND | LOCK_EX);
            exit(1);
            break;

        case E_USER_WARNING:
            file_put_contents($logfile, date("y-m-d H:i:s.").gettimeofday()["usec"] . " $filename ($errline): " . "WARNING >> message = $errstr\n", FILE_APPEND | LOCK_EX);
            break;

        case E_USER_NOTICE:
            file_put_contents($logfile, date("y-m-d H:i:s.").gettimeofday()["usec"] . " $filename ($errline): " . "NOTICE >> message = $errstr\n", FILE_APPEND | LOCK_EX);
            break;

        default:
            file_put_contents($logfile, date("Y-M-d H:i:s.").gettimeofday()["usec"] . " $filename ($errline): " . "UNKNOWN >> message = $errstr\n", FILE_APPEND | LOCK_EX);
            break;
    }

    // delete any files older than 30 days
    $files = glob($logfile_dir . "*");
    $now   = time();

    foreach ($files as $file)  
        if (is_file($file))
            if ($now - filemtime($file) >= 60 * 60 * 24 * $logfile_delete_days)
                unlink($file);

    return true;    // Don't execute PHP internal error handler
}