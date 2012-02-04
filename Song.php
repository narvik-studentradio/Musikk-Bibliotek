<?php
class Song {
    private $sangid;
    private $artist;
    private $title;
    private $album;
    private $duration;
    private $lastPlayed;
    private $playcounter;
    private $type;
    
    function __construct($sangid, $artist, $title, $album, $duration, $lastPlayed, $playcounter, $type)
    {
        $this->sangid = $sangid;
        $this->artist = $artist;
		echo $this->artist;
        $this->title = $title;
        $this->album = $album;
        $this->duration = $duration;
        $this->lastPlayed = $lastPlayed;
        $this->playcounter = $playcounter;
        $this->type = $type;
    }
    
    function getXmlItem()
    {
        $remaining = ($this->lastPlayed + $this->duration - time());
        $remaining = ($remaining < 1 ? 0 : $remaining);
        return "\t<item>\n"
        . "\t\t<artist>$this->artist</artist>\n"
        . "\t\t<title>$this->title</title>\n"
        . "\t\t<album>$this->album</album>\n"
        . "\t\t<remaining>$remaining</remaining>\n"
        . "\t\t<lastPlayed>" . date(r, $this->lastPlayed) . "</lastPlayed>\n"
        . "\t\t<duration>$this->duration</duration>\n"
        . "\t\t<type>$this->type</type>\n"
        . "\t</item>\n";
    }
    
    public function getPosition($seconds)
    {
        return time() - $lastPlayed;
        
        if ($seconds)
        {
            return $position;
        } else {
            $hrs = floor ($position / 3600);
            $mins = floor ($position / 60)% 60;
            $secs = $position % 60;
            return ($hrs > 0? $hrs . ":" : "") . ($mins > 0 ? $mins . ":" : "") . $secs;
        }
    }
}
