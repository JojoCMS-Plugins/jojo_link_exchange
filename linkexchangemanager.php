<?php

class Jojo_Plugin_Linkexchangemanager extends Jojo_Plugin
{

    function _getContent()
    {
        global $smarty, $_USERGROUPS, $templateoptions;

        $content = array();

ini_set('max_execution_time', 900); //this could take a while



if (isset($_GET['id'])) {
    $linkexchanges = Jojo::selectQuery("SELECT * FROM linkexchange WHERE linkexchangeid=".$_GET['id']." LIMIT 1");
} else {
    $linkexchanges = Jojo::selectQuery("SELECT * FROM linkexchange WHERE 1");
}
if ($_GET['action'] == 'update') {
    for ($i=0;$i<count($linkexchanges);$i++) {
        //PAGERANK

        $newpr = getpagerank($linkexchanges[$i]['lx_reciprocalurl']);
        if (($newpr != $linkexchanges[$i]['lx_pagerank']) && (is_int($newpr)) ) {
            Jojo::selectQuery("UPDATE linkexchange SET lx_pagerank = ? WHERE linkexchangeid = ? LIMIT 1", array($newpr, $linkexchanges[$i]['linkexchangeid']));
        }

        //Check link is still active
        $linkdata = Jojo_Plugin_Linkexchangemanager::findlink(_SITEURL,$linkexchanges[$i]['lx_reciprocalurl']);
        //check if number of external links on page has changed
        if ($linkdata['external'] != $linkexchanges[$i]['lx_linksonpage']) {
            Jojo::selectQuery("UPDATE linkexchange SET lx_linksonpage = ? WHERE linkexchangeid = ? LIMIT 1", array($linkdata['external'], $linkexchanges[$i]['linkexchangeid']));
        }
        //check if our link is still on page
        if ($linkdata['linkfound'] and ($linkexchanges[$i]['lx_status'] == 'missing')) {
            Jojo::selectQuery("UPDATE linkexchange SET lx_status='ok' WHERE linkexchangeid = ? LIMIT 1", array($linkexchanges[$i]['linkexchangeid']));
        }
        if (!$linkdata['linkfound'] and ($linkexchanges[$i]['lx_status'] == 'ok')) {
            Jojo::selectQuery("UPDATE linkexchange SET lx_status='missing' WHERE linkexchangeid = ? LIMIT 1", array($linkexchanges[$i]['linkexchangeid']));
        }
        //update lastchecked
        Jojo::selectQuery("UPDATE linkexchange SET lx_lastchecked=NOW() WHERE linkexchangeid = ? LIMIT 1", array($linkexchanges[$i]['linkexchangeid']));
    }
    $linkexchanges = Jojo::selectQuery("SELECT * FROM linkexchange WHERE 1"); //refresh the data as it may have been updated

    function findlink($needle,$haystack)
    {
        require_once(_BASEPLUGINDIR . "/jojo_core/external/snoopy/Snoopy.class.php");
        $snoopy = new Snoopy;
        $internal = 0;
        $external = 0;
        $linkfound = false;

        $snoopy->fetchlinks($haystack);
        if (is_array($snoopy->results)) {
            for ($i=0;$i<count($snoopy->results);$i++) {
                if (strpos($snoopy->results[$i],$haystack) === false) {
                    $external++;
                    //echo $snoopy->results[$i]."<br />";
                    if (strpos($snoopy->results[$i],$needle) !== false) {
                        $linkfound = true;
                    }
                } else {
                    $internal++;
                }
            }
        }
        $ret = array();
        $ret['internal'] = $internal;
        $ret['external'] = $external;
        $ret['linkfound'] = $linkfound;
        return $ret;
    }

}

$smarty->assign('linkexchanges',$linkexchanges);

include(_BASEDIR.'/includes/admin-menu.inc.php');
        $content['content'] = $smarty->fetch('admin.tpl');

        return $content;
    }

}