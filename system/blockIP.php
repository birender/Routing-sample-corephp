<?php
// Site Block for specified IP's
$blockIP = array("192.168.0.2");
if(in_array($_SERVER['REMOTE_ADDR'], $blockIP))
{
	echo "Your IP [".$_SERVER['REMOTE_ADDR']."] is blocked by administrator. Please Contact Support";
	exit(0);
}
