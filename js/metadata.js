var xmlDoc;
var songs;
var fetchTimestamp;

function loadxml() {
	songs = []
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
		fetchTimestamp = new Date().getTime();
		x = xmlDoc.responseXML.documentElement.getElementsByTagName("item");
		for ( var i = 0; i < x.length; i += 1) {
			songs
					.push({
						artist : x[i].getElementsByTagName("artist")[0].firstChild.nodeValue,
						title : x[i].getElementsByTagName("title")[0].firstChild.nodeValue,
						album : x[i].getElementsByTagName("album")[0].firstChild.nodeValue,
						remaining : x[i].getElementsByTagName("remaining")[0].firstChild.nodeValue,
						lastPlayed : x[i].getElementsByTagName("lastPlayed")[0].firstChild.nodeValue,
						duration : x[i].getElementsByTagName("duration")[0].firstChild.nodeValue,
						type : x[i].getElementsByTagName("type")[0].firstChild.nodeValue
					});
		}
	}
}

function getLarge(s) {
	return "\t<img class=\"cover_big\" src=\"http://nsr.samfunnet.no/m/gfx/Albumcover.png\" alt\"cover\" style=\"border: 1px solid black; width:96px; height: 95px; float: left; overflow: hidden;\"/>\n"
			+ "\t<div style=\"width: 195px; float: left; text-align: left; padding: 0px; overflow: hidden;\">\n"
			+ "\t\t<p style=\"margin: 5px;\">\n"
			+ s.title
			+ "<br>by: "
			+ s.artist
			+ "<br>"
			+ s.album
			+ "\n"
			+ "\t\t</p>\n"
			+ "\t</div>\n"
			+ "\t<div id=\"current_buttons\" style=\"width: 23px; height: 95px; float: left; padding: 0px; overflow: hidden; position:relative;\">\n"
			+ "\t\t<img src=\"http://nsr.samfunnet.no/m/gfx/i.png\" alt=\"info\" style=\"position:absolute; top: 0; right: 0; width:23px; height: 23px; overflow: hidden;\" />\n"
			+ "\t\t<img src=\"http://nsr.samfunnet.no/m/gfx/jamendo.png\" alt=\"type\" style=\"position:absolute; bottom: 0; right: 0; width:23px; height: 23px; overflow: hidden;\" />\n"
			+ "\t</div>"
}

function getSmall(s) {
	return "<div style=\"width: 318px; border: 1px solid black; margin-top:5px;\">\n"
			+ "\t<img class=\"cover_small\" src=\"http://nsr.samfunnet.no/m/gfx/Albumcover.png\" alt\"cover\" style=\"border: 1px solid black; width:23px; height: 23px; float: left; margin-top: 4px;\"/>\n"
			+ "\t<div style=\"width: 247px; height: 32px; float: left; text-align: left; padding: 0px;\">\n"
			+ "\t\t<p style=\"margin-top: 4px; margin-left: 5px; margin-bottom: 0px; margin-top: 0px; font-size: small;\">"
			+ s.title
			+ "<br>by: "
			+ s.artist
			+ "</p>\n"
			+ "\t</div>\n"
			+ "\t<img src=\"http://nsr.samfunnet.no/m/gfx/i.png\" alt=\"type\" style=\"float: right; width:23px; height: 23px; margin-top: 4px;\" />\n"
			+ "\t<img src=\"http://nsr.samfunnet.no/m/gfx/jamendo.png\" alt=\"type\" style=\"float: right; height: 23px; width:23px; margin-top: 4px;\" />\n"
			+ "</div>"
}

function getSeek(s) {
	var played = s.duration - getRemaining();
	var percentage = Math.floor((played / s.duration) * 100);
	return "<div id=\"progress\" style=\"width:"
			+ percentage
			+ "%; height: 13px; background-color: gray; float: left;\"></div>\n"
			+ "<span id=\"timestamp\" style=\"float: right; clear: both;\">" + createTimestamp(played) +" - "
			+ createTimestamp(s.duration) + "</span>\n";
}

function createTimestamp($seconds) {
	var $hrs = Math.floor($seconds / 3600);
	var $mins = Math.floor($seconds / 60) % 60;
	var $secs = $seconds % 60;
	return ($hrs > 0 ? $hrs + ":" : "") + ($mins < 10 ? "0" : "") + $mins + ":"
			+ ($secs < 10 ? "0" : "") + $secs;
}

function updateSeek() {
	document.getElementById('seek').innerHTML = getSeek(songs[0]);
	var t=setTimeout("updateSeek()",500);
}

function updateXml() {
	loadxml();
	
	document.getElementById('current').innerHTML = getLarge(songs[0]);
	document.getElementById('current').style.border="1px solid black";
	var gen = "";
	for ( var i = 1; i < songs.length; i += 1) {
		gen += getSmall(songs[i]);
	}
	document.getElementById('previous').innerHTML = gen;
	
	var next = getRemaining() + 2;
	if (next < 10)
		next += 10;
	next *= 1000;
	
	var t=setTimeout("updateXml()", next);
}

function getRemaining() {
	var remaining = songs[0].remaining - Math.floor((new Date().getTime() - fetchTimestamp)/1000)
	if (remaining <= 0)
		remaining = 0;
	return remaining;
}