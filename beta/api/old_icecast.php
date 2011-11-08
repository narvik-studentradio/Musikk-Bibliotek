<?php
class IceCast {
    var $server = "http://stream.sysrq.no:8000/status2.xsl";
    var $radio_info=array();

    function __construct() {
        $this->radio_info['now_playing']['artist'] = 'ukjent';
        $this->radio_info['now_playing']['track'] = 'ukjent';
    }

    function getStatus() {
        $stats = file($this->server);
        $status = explode(",", $stats[5]);
        $artist = explode("-", $status[5]);

        $this->radio_info['now_playing']['artist'] = $artist[1];
        $this->radio_info['now_playing']['track'] = $artist[2];
       
        return $this->radio_info;
    }
}
?>
