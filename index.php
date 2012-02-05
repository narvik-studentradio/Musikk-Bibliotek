<?
/*
 * 			NSR-MB V0.2
 * Forsiden. Inneholder ikke noe vital PHP-kode. (Move along)
 *
 */
include 'settings.php';
include("Song.php");

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

$reloadCountdown = ($Songs[0]->getRemaining() < 10 ? $Songs[0]->getRemaining() : $Songs[0]->getRemaining() + 10);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php    echo $owner;?>- Musikkbibliotek</title>
		<link rel="stylesheet" type="text/css" href="browser.css" />
		<meta http-equiv="refresh" content="<?php echo $$reloadCountdown; ?>">
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1><?php  echo $owner;?>: Musikkbibliotek</h1>
				<h2>Siste oppdatering fra spiller: <?php  echo date("H:i:s d.m.Y", $Songs[0]->lastPlayed);?></h2>
			</div>
			<!-- Big box for the currently playing song -->
			<div id="current_box">
				<h2>Spilles n&aring;</h2>
				<img src="http://imgjam.com/albums/s91/91153/covers/1.200.jpg" />
				<p class="songtitle">
					<?php  echo $Songs[0]->title; ?><br>
					<small>Av: <?php  echo $Songs[0]->artist; ?></small>
				</p>
				<p class="info">
					Started: <?php  echo date("H:i:s", $Songs[0]->lastPlayed);?>
				</p>
				<p class="info">
					Current: <?php  echo date("H:i:s", (time() - $Songs[0]->lastPlayed)); ?>
				</p>
				<p class="info">
					Duration: <?php  echo date("H:i:s", $Songs[0]->duration); ?>
				</p>
				<div class="clear"></div>
			</div>
			<!-- Smaller boxes for the previous 4 -->
			<?php for ($i = 1; $i < 5; $i++) { ?>
			<div class="content">
				<img src="http://imgjam.com/albums/s91/91153/covers/1.200.jpg" />
				<p class="info">
					<?php  echo $Songs[$i]->artist; ?>
					- <?php  echo $Songs[$i]->title; ?><br>
					Started: <?php echo date("H:i:s", $Songs[$i]->lastPlayed); ?><br>
					Duration: <?php echo date("H:i:s", $Songs[$i]->duration);
					?>
					<div class="clear"></div>
			</div>
			<?php }
			?>
		</div>
	</body>
</html>
