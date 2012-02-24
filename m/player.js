var hq = false;

function init() {
	if (navigator.appVersion.indexOf('CrMo') > 0
			|| navigator.appVersion.indexOf('iPhone OS') > 0
			|| navigator.appVersion.indexOf('Windows Phone OS') > 0
			|| navigator.appVersion.indexOf('iPad') > 0) {
	} else if (navigator.appVersion.indexOf('Android') > 0) {
		document.getElementById("OtherAD").innerHTML = '<h2>ADVARSEL!</h2>'
				+ '<p>Denne siden funker kun I moderne nettlesere,'
				+ ' pr&oslash;v <a href="https://market.android.com/details?id=com.android.chrome">Chrome for Android</a>.<br>'
				+ 'Selvstendig Android app er under utvikling '
				+ 'men er ikke ferdig enda. Beklager.</p>';
	} else {
		document.getElementById("OtherAD").innerHTML = '<h2>ADVARSEL!</h2>'
				+ '<p>Denne siden er beregnet for iOS, Chrome Mobile og Windows Phone 7.5. Avspilling kan v&aelig;re problematisk.</p>';
	}
	updateStatus();
}

function PlayHQ() {
	hq = true;
	document.getElementById("player").innerHTML = '<audio controls autoplay loop>'
			+ '<source src="http://stream.sysrq.no:8000/00-nsr.ogg" type="audio/ogg">'
			+ '<source src="http://stream.sysrq.no:8000/00-nsr.mp3" type="audio/mp3">'
			+ '<!-- fallback -->'
			+ '<p>Nettleseren din st&oslash;tter ikke HTML5 lyd.</p>'
			+ '</audio>';
	Pause();
}
function PlayLQ() {
	hq = false;
	document.getElementById("player").innerHTML = '<audio controls autoplay loop>'
			+ '<source src="http://stream.sysrq.no:8000/01-nsr-mobile.mp3" type="audio/mp3">'
			+ '<!-- fallback -->'
			+ '<p>Nettleseren din st&oslash;tter ikke HTML5 lyd.</p>'
			+ '</audio>';
	Pause();
}

function Play() {
	var audioPlayer = document.getElementsByTagName('audio')[0];
	if (audioPlayer.paused) {
		audioPlayer.load();
		audioPlayer.play();
	}
	updateStatus()
}

function updateStatus(){
	var audioPlayer = document.getElementsByTagName('audio')[0];
	if (audioPlayer.paused) {
		document.getElementById("status").innerHTML = "Pause";
	} else {
		document.getElementById("status").innerHTML = "Spiller " + (hq ? "HQ" : "LQ");
	}
}

function Pause() {
	var audioPlayer = document.getElementsByTagName('audio')[0];
	if (audioPlayer.paused) {
		audioPlayer.load();
		audioPlayer.play();
	} else {
		audioPlayer.pause();
	}
	updateStatus();
}

function Stop() {
	document.getElementById("status").innerHTML = "Stoppet";
	document.getElementById("player").innerHTML = '';
}