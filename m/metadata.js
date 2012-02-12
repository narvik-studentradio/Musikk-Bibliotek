var xmlDoc;
var songs = new Array();

function loadxml() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlDoc = new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlDoc = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlDoc.open("GET", "/xml/metadata", false);
	xmlDoc.send();
	xmlDoc.onreadystatechange = readXML();
}

function readXML() {
	if (xmlDoc.readyState == 4 && xmlDoc.status == 200) {
		x = xmlDoc.responseXML.documentElement.getElementsByTagName("item");
		for (i = 0; i < x.length; i++) {
			songs.push(new song([i].getElementsByTagName("artist"),
					[i].getElementsByTagName("title"),
					[i].getElementsByTagName("album"),
					[i].getElementsByTagName("remaining"),
					[i].getElementsByTagName("lastPlayed"),
					[i].getElementsByTagName("duration"),
					[i].getElementsByTagName("type")
				));
	}
}

function song(artist, title, album, remaining, lastPlayed, duration, type){
	this.artist = artist;
	this.title = title;
	this.album = album;
	this.remaining = remaining;
	this.lastPlayed = lastPlayed;
	this.duration = duration;
	this.type = type;
}

function getLarge(song sang){
		return "<div id\"current\" style=\"border: 1px solid black;\">\n" +
"\t<img class=\"cover_big\" src=\"gfx/Albumcover.png\" alt\"cover\" style=\"border: 1px solid black; width:96px; height: 95px; float: left; overflow: hidden;\"/>\n" +
"\t<div style=\"width: 188px; float: left; text-align: left; padding: 0px; overflow: hidden;\">\n" +
"\t\t<p style=\"margin: 5px;\">\n" + track + "<br>by: " + artist + "<br>" + album + "\n" +
"\t\t</p>\n" +
"\t</div>\n" +
"\t<div id=\"current_buttons\" style=\"width: 30px; height: 95px; float: left; padding: 0px; overflow: hidden; position:relative;\">\n" +
"\t\t<img src=\"gfx/i.png\" alt=\"info\" style=\"position:absolute; top: 0; right: 0; width:23px; height: 23px; overflow: hidden;\" />\n" +
"\t\t<img src=\"gfx/jamendo.png\" alt=\"type\" style=\"position:absolute; bottom: 0; right: 0; width:30px; height: 23px; overflow: hidden;\" />\n" +
"\t</div>\n" +
"</div>"
	}
	
	function getSmall()
	{
		return "<div style=\"border: 1px solid black; margin-top:5px;\">\n" +
"\t<img class=\"cover_small\" src=\"gfx/Albumcover.png\" alt\"cover\" style=\"border: 1px solid black; width:23px; height: 23px; float: left;\"/>\n" +
"\t<div style=\"width: 242px; height: 23px; float: left; text-align: left; padding: 0px;\">\n" +
"\t\t<p style=\"margin-top: 4px; margin-left: 5px; margin-bottom: 0px;\">" + artist + " - " + track + "</p>\n" +
"\t</div>\n" +
"\t<img src=\"gfx/i.png\" alt=\"type\" style=\"float: right; width:23px; height: 23px;\" />\n" +
"\t<img src=\"gfx/jamendo.png\" alt=\"type\" style=\"float: right; height: 23px; width:30px;\" />\n" +
"</div>"
	}

function getSthuff() {
	var gen;
	for (i=0;i<=songs.length;i=i++)
	{
		if (i == 0)
			gen += songs[i].getLarge();
		else
			gen += songs[i].getSmall();	
	}
	document.getElementById('current').innerHTML = gen;
}

