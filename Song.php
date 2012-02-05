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
        return "\t<item>\n"
        	// ENT_XML1 = 16
        . "\t\t<artist>" . htmlspecialchars ($this->artist, 16, "UTF-8") . "</artist>\n"
        . "\t\t<title>" . htmlspecialchars ($this->title, 16, "UTF-8") . "</title>\n"
        . "\t\t<album>" . htmlspecialchars ($this->album, 16, "UTF-8") . "</album>\n"
        . "\t\t<remaining>" . htmlspecialchars (getRemaining(), 16, "UTF-8") . "</remaining>\n"
        . "\t\t<lastPlayed>" . htmlspecialchars (date(r, $this->lastPlayed), 16, "UTF-8") . "</lastPlayed>\n"
        . "\t\t<duration>" . htmlspecialchars ($this->duration, 16, "UTF-8") . "</duration>\n"
        . "\t\t<type>" . htmlspecialchars ($this->type, 16, "UTF-8") . "</type>\n"
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
    
	public function getRemaining()
	{
		$remaining = ($this->lastPlayed + $this->duration - time());
         return ($remaining < 1 ? 0 : $remaining);
	}
}
