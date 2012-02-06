<?php
class Song {
    public $sangid;
    public $artist;
    public $title;
    public $album;
    private $duration;
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
        . "\t\t<remaining>" . htmlspecialchars ($this->getRemaining(), 16, "UTF-8") . "</remaining>\n"
        . "\t\t<lastPlayed>" . htmlspecialchars (date(r, $this->lastPlayed), 16, "UTF-8") . "</lastPlayed>\n"
        . "\t\t<duration>" . htmlspecialchars ($this->duration, 16, "UTF-8") . "</duration>\n"
        . "\t\t<type>" . htmlspecialchars ($this->type, 16, "UTF-8") . "</type>\n"
        . "\t</item>\n";
    }
    
    function getPosition()
    {
        return time() - $this->lastPlayed;
    }
	
	function getDuration()
    {
		return $this->duration;
    }
    
	public function getRemaining()
	{
		$remaining = ($this->lastPlayed + $this->duration - time());
         return ($remaining < 1 ? 0 : $remaining);
	}
}
