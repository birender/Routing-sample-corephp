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
				include_once($directory."/".$file);
			}
		}
	}
}