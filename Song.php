<?php
class Song {
    public $sangid;
    public $artist;
    public $title;
    public $album;
    public $duration;
    public $lastPlayed;
    public $playcounter;
    public $type;
    
    function __construct($sangid, $artist, $title, $album, $duration, $lastPlayed, $playcounter, $type)
    {
        $this->sangid = $sangid;
        $this->artist = $artist;
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
        . "\t\t<artist>" . htmlspecialchars ($this->artist, ENT_XML1, "UTF-8") . "</artist>\n"
        . "\t\t<title>" . htmlspecialchars ($this->title, ENT_XML1, "UTF-8") . "</title>\n"
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
