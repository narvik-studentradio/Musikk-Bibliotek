<?php
/*
 * Outputs metadata for the X last tracks
 * Accepts input for number of tracks to output
 * Use ?tracks=X to specify from 1-100
 * 
 * Suggested url: /xml/metadata
 */

/*
 * Include settings
 */
include("../settings.php");
include("../Song.php");
header("Content-type: text/xml");

/*
 * Lets figure out how many tracks to return
 */
$limit = (int) mysql_real_escape_string ($_GET["tracks"]);
if (($limit > 0) && ($limit <= 100)) {
	$limit = $limit;
} else {
	$limit = 5;
}

$Songs = array();

/*
 * Lets query the database get all the Songs
 */

$query = "SELECT * FROM library ORDER BY lastPlayed DESC LIMIT $limit";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
	$Songs[] = new Song($row["sangid"], $row["artist"], $row["title"], $row["album"], $row["duration"], $row["lastPlayed"], $row["playcounter"], $row["type"]);
}


/*
 * Please leave an issue if you have a better format suggestion
 * https://github.com/narvik-studentradio/Musikk-Bibliotek/issues
 */
// PHP dislikes text containing <?
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

?>
<metadata>
	<title>Metadata for <?php echo $owner;?></title>
	<dateCreated><?php  echo date(r, $Songs[0]->lastPlayed);?></dateCreated>
	<dateModified><?php  echo date(r, time());?></dateModified>
	<ownerName><?php  echo $owner;?></ownerName>
	<ownerEmail><?php  echo $owner_mail;?></ownerEmail>
<?php
/*
 * Lets print the all the xmlItems
 */
foreach ($Songs as &$sang) {
	echo $sang->getXmlItem();
} 
/*
 * Lets end the tags started at the beginning
 */
?>
</metadata>