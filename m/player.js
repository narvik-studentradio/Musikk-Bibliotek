function init(){
  if (navigator.appVersion.indexOf('CrMo') > 0 || navigator.appVersion.indexOf('iPhone OS') > 0 || navigator.appVersion.indexOf('Windows Phone OS') > 0 || navigator.appVersion.indexOf('iPad') > 0)
  {
    document.getElementById("OtherAD").innerHTML='';
  }
  else if (navigator.appVersion.indexOf('Android') > 0)
  {
    document.getElementById("OtherAD").innerHTML='<h2>ADVARSEL!</h2>' + 
    '<p>Denne siden funker kun I moderne nettlesere,' +
    ' pr&oslash;v <a href="https://market.android.com/details?id=com.android.chrome">Chrome for Android</a>' + 
    ' (<a href="http://development.giaever.org/files/Android/com.android.chrome.apk">apk</a>).<br>' + 
    'Selvstendig Android app er under utvikling ' +
    'men er ikke ferdig enda. Beklager.</p>';
  }
  else
  {
    document.getElementById("OtherAD").innerHTML='<h2>ADVARSEL!</h2>' + 
    '<p>Denne siden er beregnet for iOS, Chrome Mobile og Windows Phone 7.5. Avspilling kan v&aelig;re problematisk.</p>';
  }
}

function PlayHQ(){
  document.getElementById("player").innerHTML='H&oslash;ykvalitets lyd<br>' +
  '<audio controls autoplay loop>' +
  '<source src="http://stream.sysrq.no:8000/00-nsr.ogg" type="audio/ogg">' +
  '<source src="http://stream.sysrq.no:8000/00-nsr.mp3" type="audio/mp3">' + 
  '<!-- fallback -->' +
  '<p>Nettleseren din st&oslash;tter ikke HTML5 lyd.</p>' +
  '</audio>';
  Pause();
}
function PlayLQ(){
  document.getElementById("player").innerHTML='Lavkvalitets lyd<br>' +
  '<audio controls autoplay loop>' +
  '<source src="http://stream.sysrq.no:8000/01-nsr-mobile.mp3" type="audio/mp3">' +
  '<!-- fallback -->' +
  '<p>Nettleseren din st&oslash;tter ikke HTML5 lyd.</p>' +
  '</audio>';
  Pause();
}

function Play()
{
  var audioPlayer = document.getElementsByTagName('audio')[0];
  if (audioPlayer.paused) {
    audioPlayer.load();
    audioPlayer.play();
    document.getElementById("status").innerHTML="Spiller";
  }
}

function Pause()
{
  var audioPlayer = document.getElementsByTagName('audio')[0];
  if (audioPlayer.paused) {
    audioPlayer.load();
    audioPlayer.play();
    document.getElementById("status").innerHTML="Spiller";
  } else {
    audioPlayer.pause();
    document.getElementById("status").innerHTML="Pause";
  }
}

function Stop(){
  document.getElementById("status").innerHTML="Stoppet";
  document.getElementById("player").innerHTML='';
}

window.onload = init;