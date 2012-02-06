<?php

function createTimestamp($seconds) {
	$hrs = floor($seconds / 3600);
	$mins = floor($seconds / 60) % 60;
	$secs = $seconds % 60;
	return ($hrs > 0 ? $hrs . ":" : "") . ($mins < 10 ? "0" : "") . $mins . ":" . ($secs < 10 ? "0" : "") . $secs;
}
