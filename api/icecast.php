<?php
/*
 * admin/metadata skal skrives til denne filen
 *
 * http://server:port/admin/metadata
 * 		?mount=ignored
 * 		&mode=updinfo
 * 		&song=remains backword compadible
 * 		&artist=artist
 * 		&title=title
 * 		&duration=sekunder
 * 		&type=(jamendo,live,promo)
 * Eks:
 * nsrmb.samfunnet.no/admin/metadata?mount=lol&mode=updinfo&song=ignored&artist=WAYDJ&title=CutMeNot%20-%20SSAN&duration=500&type=test
 */

/*
 * Include settings
 */
include ("../settings.php");

/*
 * HTTP authentication
 */
if (!(($_SERVER['PHP_AUTH_USER'] == $ice_auth_id) && ($_SERVER['PHP_AUTH_PW'] == $ice_auth_pw))) {
	header('WWW-Authenticate: Basic realm="Icecast metadata api for NSR-MB"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Authentication failed...';
	exit ;
}

/*
 * Stuff needed here:
 */
$mode = $_GET["mode"];
$artist = $_GET["artist"];
$title = $_GET["title"];
$duration = $_GET["duration"];
$type = $_GET["type"];
$now = time();

/*
 * Backwords comapadibilety
 */
$song = $_GET["song"];

/*
 * Lets check that it contains something usable
 */
if (($artist == "") && ($title == "") && ($song == "")) {
	//This is bs, gtfo
	echo "Invalid query!";
	exit ;
}

/*
 * Not getting separate title and artist
 */
if (($artist == "") && ($title == "")) {
	$metadata = explode("-", $song, 2);

	//We assume Artist does not contain "-"
	$artist = $metadata[0];
	$title = $metadata[1];
}

/*
 * If we don't get a content type set it to the default
 */
if ($type == "") {
	$type = $defaultContentType;
}

/*
 * Check to see duration is set for previous track. If not; assume it endend when this started
 */
$query = "SELECT * FROM library ORDER BY lastPlayed DESC LIMIT 1";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
	if ($row["duration"] == NULL) {
		$query = "UPDATE library SET duration = '" . ($now - $row["lastPlayed"]) . "' WHERE sangid = '" . $row["sangid"] . "'";
		mysql_query($query) or die(mysql_error());
	}
}

/*
 * Check if Songs metadata allready exist in db and update or insert accordingly
 */
$query = "SELECT * FROM library WHERE artist = '$artist' AND title = '$title' LIMIT 1";
$result = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($result) < 1) {
	if ($duration == "") {
		$duration = Null;
	}
	
	$query = "INSERT INTO library (artist, title , duration, lastPlayed, type) VALUES('$artist', '$title', '$duration', '$now', '$type')";
	mysql_query($query) or die(mysql_error());
} else {
	while ($row = mysql_fetch_array($result)) {
		$query = "UPDATE library SET lastPlayed = '$now', playcounter = '" . ($row["playcounter"] + 1) . "' WHERE sangid = '" . $row["sangid"] . "'";
		mysql_query($query) or die(mysql_error());
	}
}
?>