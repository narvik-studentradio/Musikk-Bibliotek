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

/*
 * Lets figure out how many tracks to return
 */
$limit = (int) mysql_real_escape_string ($_GET["tracks"]);
if (($limit > 0) && ($limit <= 100)) {
	$limit = $limit;
} else {
	$limit = 5;
}

/*
 * I will build this as an OPML
 * Please leave an issue if you have a better format suggestion
 * https://github.com/narvik-studentradio/Musikk-Bibliotek/issues
 */
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; // PHP dislikes text containing <?
?>
<opml version="1.1">
	<head>
		<title>Metadata for <?php echo $owner; ?></title>
		<dateCreated><?php echo date(r, time()); ?></dateCreated>
		<dateModified><?php echo date(r, time()); ?></dateModified>
		<ownerName><?php echo $owner; ?></ownerName> 
		<ownerEmail><?php echo $owner_mail; ?></ownerEmail>
	</head>
	<body>
		<outline title="<?php echo $owner; ?>" text="<?php echo $owner; ?>">
<?php
/*
 * Lets query the database and print the outlines
 */
$query = "SELECT * FROM library ORDER BY lastPlayed DESC LIMIT $limit";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {?>
			<outline
				type="<?php echo $row["type"]; ?>"
				artist="<?php echo $row["artist"]; ?>"
				title="<?php echo $row["title"]; ?>"
				album="<?php echo $row["album"]; ?>"
				remaining="<?php $remaining = ($row["lastPlayed"]+$row["duration"]-time()); echo ($remaining < 1? 0 : $remaining); ?>"
				lastPlayed="<?php echo date(r, $row["lastPlayed"]); ?>"
				duration="<?php echo $row["duration"]; ?>"
			/>
<?php } 
/*
 * Lets end the tags started at the beginning
 */
?>		</outline>
	</body>
</opml>