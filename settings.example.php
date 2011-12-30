<?php
/*	----------------------------------------
 *	General
 *	--------------------------------------*/

$useSsl = false;
$defaultContentType = "Jamendo";
date_default_timezone_set("Europe/Berlin");

/*	----------------------------------------
 *	Features
 *	--------------------------------------*/

$feature_api_icecast = false;
$feature_api_jamendo = false;
$feature_api_http_metadata = false;

/*	----------------------------------------
 *	mySQL configuration
 *	--------------------------------------*/

$dbHost= "localhost";
$dbUser ="nsrmb";
$dbPass = "goobeligook";
$dbName = "nsrmb";
$dbPrefix = "mb_";
//$dbTable = "";

$connection = mysql_connect($dbHost, $dbUser, $dbPass) or die(mysql_error());
mysql_select_db($dbName) or die(mysql_error());
?>