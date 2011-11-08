<?
/*
 * 			NSR-MB V0.2
 * Forsiden. Inneholder ikke noe vital PHP-kode. (Move along)
 *
 */
?>

<html>
	<head>
		<title>Narvik Studentradio - Musikkbibliotek (NSR-MB)</title>
		<style>
			body {
				padding: 0px;
				margin: 0px;
				font-family: sans-serif;
				font-size: 12px;
			}
			#wrapper {
				width: 960px;
				margin: 0px auto;
			}
			
			#header {
				width: 100%;
				text-align: center;
			}
			
			#current_box {
				width: 100%;
				border: 2px solid black;
			}
			
			#current_box h2 {
				padding: 0px;
				margin: 0px;
				background-color: green;
				text-align: center;
				color: white;
				font-weight: bold;
			}
			
			#current_box  img {
            float: left;
            padding: 2px;
            margin: 5px;
            width: 100px;
            height: 100px;
            border: 1px solid black;
            background-color: green;
            }
            
            .clear {
            	clear: both;
            }
            
            p.songtitle {
            	padding: 0px;
            	margin: 5px;
            	font-size: 20px;
            	font-weight: bold;
            }

		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1>Narvik Studentradio: Musikkbibliotek</h1>
				<h2>Siste oppdatering fra spiller: XX-XX-XX YY:YY:YY</h2>
			</div>
			<div id="current_box">
				<h2>Spilles nå</h2>
				<img src="http://imgjam.com/albums/s91/91153/covers/1.200.jpg" />
				<p class="songtitle">Artist - Title</p>
				<p class="info">Started: XX:XX</p>
				<p class="info">Current: XX:XX</p>
				<p class="info">Duration: XX:XX</p>
				<div class="clear"></div>
			</div>
			<div id="content"></div>
		</div>
	</body>
</html>