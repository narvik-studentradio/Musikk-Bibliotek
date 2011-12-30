<?php
/* 
 * admin/metadata skal skrives til denne filen
 * 
 * http://server:port/admin/metadata
 * 		?mount=ignored
 * 		&mode=updinfo
 * 		&song=ignored
 * 		&artist=artist
 * 		&title=title
 * 		&duration=sekunder
 * 		&type=(jamendo,live,promo)
 * Eks:
 * nsrmb.samfunnet.no/beta/admin/metadata?mount=lol&mode=updinfo&song=ignored&artist=WAYDJ&title=CutMeNot%20-%20SSAN&duration=500&type=test
 * nsrmb.samfunnet.no/beta/admin/metadata?&title= &duration=321321345345
 */

 /*
  * Stuff needed here:
  */
$mode = $_GET["mode"];
$artist = $_GET["artist"];
$title = $_GET["title"];
$duration = $_GET["duration"];
$type = $_GET["type"];
$now = $time();

/*
 * Backwords comapadibilety
 */
$song = $_GET["song"];

echo "Mode: $mode, Artist: $artist, Title: $title, Duration: $duration, Type: $type";

/*
 * Lets check that it contains something usable
 */
if(($artist == "") && ($title == "") && ($song == ""))
{
	//This is bs, gtfo
	echo "Invalid query!";
	exit;
}

/*
 * Not getting separate title and artist
 */
if(($artist == "") && ($title == ""))
{
	$metadata = explode("-", $song, 2);
	
	//We assume Artist does not contain "-"
	$artist = $metadata[0];
	$title = $metadata[1];
}

/*
 * Check if Songs metadata allready exist in db
 */
$query = "SELECT * FROM library WHERE artist = $artist AND title = $title";

/*
 * Check to see duration is set for previus track. If not; assume it endend when the new started
 */
?>