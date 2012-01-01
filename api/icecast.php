<?php
/*
 * admin/metadata skal leses fra denne filen
 *
 * http://id:pw@server:port/admin/metadata
 * 		?mount=ignored
 * 		&mode=updinfo			//Should we do anything special with this?
 * 		&song=remains backward compatible
 * 		&artist=artist			//New, used in nsr-mp
 * 		&title=title			//New, used in nsr-mp
 * 		&duration=sekunder		//New, used in nsr-mp
 * 		&type=(jamendo,live,promo)	//New, used in nsr-mp
 * Eks:
 * nsrmb.samfunnet.no/admin/metadata?mount=lol&mode=updinfo&song=ignored&artist=WAYDJ&title=CutMeNot%20-%20SSAN&duration=500&type=test
 */

/*
 * Include settings, file is required (halts execution if missing)
 * It could get ugly if ice_auth was not set
 */
require("../settings.php");

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
$mode = mysql_real_escape_string ($_GET["mode"]);
$artist = mysql_real_escape_string ($_GET["artist"]);
$title = mysql_real_escape_string ($_GET["title"]);
$duration = mysql_real_escape_string ($_GET["duration"]);
$type = mysql_real_escape_string ($_GET["type"]);
$now = time();

/*
 * Backwords comapadibilety
 */
$song = mysql_real_escape_string ($_GET["song"]);

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