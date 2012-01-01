<?
/*
 * 			NSR-MB V0.2
 * Forsiden. Inneholder ikke noe vital PHP-kode. (Move along)
 *
 */
include 'settings.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php    echo $owner;?>- Musikkbibliotek</title>
		<link rel="stylesheet" type="text/css" href="browser.css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1><?php  echo $owner;?>: Musikkbibliotek</h1>
				<?php $query = "SELECT * FROM library ORDER BY lastPlayed DESC LIMIT 1";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
				?>
				<h2>Siste oppdatering fra spiller: <?php  echo date("H:i:s d.m.Y", $row["lastPlayed"]);?></h2>
				<?php  }?>
			</div>
			<?php
/*
* Big box for the currently playing song
*/
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
			?>
			<div id="current_box">
				<h2>Spilles nå</h2>
				<img src="http://imgjam.com/albums/s91/91153/covers/1.200.jpg" />
				<p class="songtitle">
					<?php  echo $row["title"];?><br>
					<small>Av: <?php  echo $row["artist"];?></small>
				</p>
				<p class="info">
					Started: <?php  echo date("H:i:s", $row["lastPlayed"]);?>
				</p>
				<p class="info">
					Current: <?php  echo date("H:i:s", (time() - $row["lastPlayed"]));?>
				</p>
				<p class="info">
					Duration: <?php  echo date("H:i:s", $row["duration"]);?>
				</p>
				<div class="clear"></div>
			</div>
			<?php  }?>
			<?php
/*
* Smaller boxes for the previous 4
*/
$query = "SELECT * FROM library ORDER BY lastPlayed DESC LIMIT 1, 4";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
			?>
			<div class="content">
				<img src="http://imgjam.com/albums/s91/91153/covers/1.200.jpg" />
				<p class="info">
					<?php  echo $row["artist"];?>
					- <?php  echo $row["title"];?><br>
					Started: <?php echo date("H:i:s", $row["lastPlayed"]);?><br>
					Duration: <?php echo date("H:i:s", $row["duration"]);
					?>
					<div class="clear"></div>
			</div>
			<?php }
			?>
		</div>
	</body>
</html>
