<?php

/**
 *  Include All Files (.php) in library folder
 */

function load_library() {
	$directory = './library';
	$scan = scandir($directory);
	unset($scan[0], $scan[1]); //unset . and ..
	foreach($scan as $file){ 
		$extention = explode(".",$file);
		if( count($extention) > 0 ){
			$fileExtention = $extention[count($extention)-1];
			if(strtolower($fileExtention) == 'php') {
				include_once($directory."/".$file);
			}
		}
	}
}

// --------------------------------------------------------------------------------
if( AUTOLOAD_HELPER == 1 ) {
	load_helper();
}

/**
 * Include All Files (.php) in helper folder
 */
function load_helper() {
	$directory = './helper';
	$scan = scandir($directory);
	unset($scan[0], $scan[1]); //unset . and ..
	foreach($scan as $file){ 
		$extention = explode(".",$file);
		if( count($extention) > 0 ){
			$fileExtention = $extention[count($extention)-1];
			if(strtolower($fileExtention) == 'php') {  
				require_once($directory."/".$file);
			}
		}
	}
} 
