<?php
$table='linkexchange';

//drop default so can have the lastmod as a datetimestamp
$result=Jojo::structureQuery("ALTER TABLE {$table} CHANGE `lx_dateadded` `lx_dateadded` TIMESTAMP NOT NULL DEFAULT 0");

$query = "
CREATE TABLE {$table} (
    `linkexchangeid` int(11) NOT NULL auto_increment,
    `lx_name` varchar(255) NOT NULL default '',
    `lx_linktext` varchar(255) NOT NULL default '',
    `lx_url` varchar(255) NOT NULL default '',
    `lx_desc` text NOT NULL,
    `lx_hits` int(11) NOT NULL default '0',
    `lx_categoryid` int(11) NOT NULL default '0',
    `lx_phone` varchar(100) NOT NULL default '',
    `lx_order` int(11) NOT NULL default '0',
    `lx_pagerank` int(11) NOT NULL default '0',
    `lx_linksonpage` int(11) NOT NULL default '0',
    `lx_reciprocalurl` varchar(255) NOT NULL default '',
    `lx_dateadded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `lx_lastmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
    `lx_lastchecked` date NOT NULL default '0000-00-00',
    `lx_status` enum('ok','missing','blocked') NOT NULL default 'ok',
    `lx_active` enum('yes','no') NOT NULL default 'yes',
    `lx_webmastername` varchar(255) NOT NULL default '',
    `lx_webmasteremail` varchar(255) NOT NULL default '',
    `lx_body` text NOT NULL,
    `lx_bbbody` text NOT NULL,
    `lx_priority` enum('high','medium','low') NOT NULL default 'low',
    `lx_image` varchar(255) NOT NULL default '',
    `lx_approvecode` varchar(40) NOT NULL,
    `lx_deletecode` varchar(40) NOT NULL,
    `lx_notes` text NOT NULL,
    PRIMARY KEY  (`linkexchangeid`)
    ) TYPE=MyISAM ;
";

$result = Jojo::checkTable($table, $query);

/* Output result */
if (isset($result['created'])) {
    echo sprintf($table.": Table <b>%s</b> Does not exist - created empty table.<br />", $table);
}

if (isset($result['added'])) {
    foreach ($result['added'] as $col => $v) {
        echo sprintf($table.": Table <b>%s</b> column <b>%s</b> Does not exist - added.<br />", $table, $col);
    }
}

if (isset($result['different'])) Jojo::printTableDifference($table, $result['different']);

/* pageurls is a spammy field we no longer need */
if (Jojo::fieldexists($table,'lx_threewayurl')) {
    echo "Removed <b>lx_threewayurl</b> from <b>$table</b><br />";
    Jojo::structureQuery("ALTER TABLE {$table} DROP `lx_threewayurl` ;");
}


//CATEGORY
$table='linkexchangecategory';
    $query = "
        CREATE TABLE {$table} (
        `linkexchangecategoryid` int(11) NOT NULL auto_increment,
        `lc_name` varchar(255) NOT NULL default '',
        `lc_desc` varchar(255) NOT NULL default '',
        `lc_body` text NOT NULL,
        `lc_bbody` text NOT NULL,
        `lc_seotitle` varchar(255) NOT NULL default '',
        `lc_order` int(11) NOT NULL default '0',
        `lc_parent` int(11) NOT NULL default '0',
        `lc_image` varchar(255) NOT NULL default '',
        PRIMARY KEY  (`linkexchangecategoryid`)
        ) TYPE=MyISAM AUTO_INCREMENT=1 ;
    ";

$result = Jojo::checkTable($table, $query);

/* Output result */
if (isset($result['created'])) {
    echo sprintf($table.": Table <b>%s</b> Does not exist - created empty table.<br />", $table);
}

if (isset($result['added'])) {
    foreach ($result['added'] as $col => $v) {
        echo sprintf($table.": Table <b>%s</b> column <b>%s</b> Does not exist - added.<br />", $table, $col);
    }
}

if (isset($result['different'])) Jojo::printTableDifference($table, $result['different']);


/* convert any old lx pages to the new plugin */
$data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_link='lx.php' OR pg_link='linkexchange.php' OR pg_link='jojo_link_exchange.php'");
foreach ($data as $page) {
    Jojo::updateQuery("UPDATE {page} SET pg_link='Jojo_Plugin_Jojo_link_exchange' WHERE pageid = ? LIMIT 1", array($page['pageid']));
}


//Link Exchange
if (Jojo::tableExists('linkexchange')) {
    $data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_link='Jojo_Plugin_Jojo_link_exchange'");
    if (!count($data)) {
        echo "Adding <b>Link Exchange</b> Page to menu<br />";
        $insertQuery = "
            INSERT INTO {page} SET
            pg_title='Sites of Interest',
            pg_url='lx',
            pg_body_code='[editor:bb]\n[[formerrors.tpl]]            \r\n[h2]Tutorial[/h2]\r\n\r\n[i]It is one thing to create relevant content, it is another thing to become [b]important[/b] relevant content in the eyes of the search engines. To help you understand about how links work, we put together this short tutorial:[/i]\r\n\r\nMost search engines consider the amount of incoming links to your website an important factor in determining your overall ranking. If many sites link to you, then the Search engines consider your site to be more important than other competing sites that don''t have any incoming links.\r\n\r\nIdeally, our content is so interesting and compelling that other webmasters will naturally want to link to it. Natural links are the best kind of links to have. They require no extra effort, are on other sites relevant to our topic and are given freely without requiring a reciprocal link (ie a link in return). It can take a long time to build natural links as good content takes time to prepare, and other webmasters will take time to find our sites and link to them.\r\n\r\nA popular way to build incoming links is Link Exchange. Many websites have a \"links\" page where they place links to other related websites. Reciprocal link building is approaching these webmasters and asking them to place a link to our site in return for us placing a link to them. It''s a topic of debate amongst SEO experts as to whether Reciprocal links are as effective as one way incoming links. While many agree that non-reciprocal links are best, it is also clear that reciprocal links (if done correctly) will help with your Page Rank and Search Engine Position.\r\n\r\nWhen choosing sites to exchange links with, there are a few things to keep in mind:\r\n[list]\r\n[*]Incoming links are most valuable on pages that are related to your content.\r\n[*]Do not link to any site that has been banned by Google (or other Search Engines), or looks like it''s spam (which may be banned in the future). If you link to a banned site, this can negatively effect your ranking.\r\n[*]Links from pages with a high PageRank are more valuable to you than pages with little or no PageRank. You can use the Google Toolbar to check the pagerank of any page on the web. While PageRank is important, it''s only a small part of the equation. Keep in mind that PageRank is only updated every 3 months (approx) so the Google Toolbar is not always an accurate reflection of this (especially on new websites).\r\n[*]The value you get from a link exchange is proportional to the number of links on the page. A link on a page with 100 other links is worth much less than a page with only 5 other links. Ideally, you should aim to get your links on pages with less than 20 other links on them.\r\n[*]The text in your link and the surrounding text is important. Good link exchanges let you place a short text description next to your link.\r\n[*]Some webmasters will place a link to you, then remove it a few weeks later. You should check your link every so often to ensure it is still active.\r\n[/list]\r\n\r\nWe are interested in exchanging links with other websites that have content similar to ours. Please use the form below to begin this process.\r\n\r\n[h2]Add Your Link[/h2]\r\nWe may be interested in a link exchange with other well-maintained websites similar to ours. We prefer to exchange links with sites that are similar to ours, but will consider high quality websites on other topics that meet our Guidelines...\r\n\r\nWe feel our sites are of a high standard, and as such are only interested in sites of a similar quality.\r\n\r\nWe are [b]only[/b] interested in links on pages that...\r\n[list]\r\n[*]Are designed for humans, not just search engines\r\n[*]Are somewhat relevant to our site\r\n[*]Are well spidered and indexed by search engines\r\n[*]Will place our link within unique content\r\n[*]Will place our link on pages with few other outgoing links, preferably less than 20\r\n[*]Are not linking to low quality websites\r\n[/list]\r\nJust to be clear, and because we get hundreds of link exchange emails that don''t meet the above criteria, we are specifically [b]not[/b] looking for...\r\n[list]\r\n[*]Link directories with hundreds of links per page\r\n[*]Link directories where the design does not match the rest of the site\r\n[*]Links on pages not spidered or indexed by the major search engines\r\n[*]Links on sites covered with ads, or \"Made for Adsense\" sites\r\n[*]Links on sites with no apparent uniqueness or value to offer\r\n[*]Links on sites not related to ours\r\n[/list]\r\n\r\n[b]Important note:[/b]\r\n\r\nWe do automatic checks on your site every so often to ensure that our link is still active and working. We also review each site manually, so it may take a couple of days for your link to appear on the site.\r\n\r\n[h4]Step 1: Please read the above guidelines[/h4]\r\nIf you are unsure as to whether your links page could be considered \"quality\", you might want to check out the [url=http://www.ragepank.com/spam-o-meter/]spam-o-meter[/url].\r\n\r\n[h4]Step 2: Add our link to your website[/h4]\r\n\r\n[[linktarget.tpl]]\r\n\r\n[b]PLEASE edit[/b] the link description text so that it is NOT the same as the above - as long as the basic message stays intact. Google does not like duplicate content.\r\n\r\n[h4]Step 3: Enter your details so we can add your link[/h4]\r\n[[linkform.tpl]]',
            pg_body='\n<h2>Tutorial</h2>\n<br />\n<em>It is one thing to create relevant content, it is another thing to become <strong>important</strong> relevant content in the eyes of the search engines. To help you understand about how links work, we put together this short tutorial:</em>\n<br />\n<br />\nMost search engines consider the amount of incoming links to your website an important factor in determining your overall ranking. If many sites link to you, then the Search engines consider your site to be more important than other competing sites that don''t have any incoming links.\n<br />\n<br />\nIdeally, our content is so interesting and compelling that other webmasters will naturally want to link to it. Natural links are the best kind of links to have. They require no extra effort, are on other sites relevant to our topic and are given freely without requiring a reciprocal link (ie a link in return). It can take a long time to build natural links as good content takes time to prepare, and other webmasters will take time to find our sites and link to them.\n<br />\n<br />\nA popular way to build incoming links is Link Exchange. Many websites have a &quot;links&quot; page where they place links to other related websites. Reciprocal link building is approaching these webmasters and asking them to place a link to our site in return for us placing a link to them. It''s a topic of debate amongst SEO experts as to whether Reciprocal links are as effective as one way incoming links. While many agree that non-reciprocal links are best, it is also clear that reciprocal links (if done correctly) will help with your Page Rank and Search Engine Position.\n<br />\n<br />\nWhen choosing sites to exchange links with, there are a few things to keep in mind:\n<br />\n<ul>\n<li>Incoming links are most valuable on pages that are related to your content.</li>\n<li>Do not link to any site that has been banned by Google (or other Search Engines), or looks like it''s spam (which may be banned in the future). If you link to a banned site, this can negatively effect your ranking.</li>\n<li>Links from pages with a high PageRank are more valuable to you than pages with little or no PageRank. You can use the Google Toolbar to check the pagerank of any page on the web. While PageRank is important, it''s only a small part of the equation. Keep in mind that PageRank is only updated every 3 months (approx) so the Google Toolbar is not always an accurate reflection of this (especially on new websites).</li>\n<li>The value you get from a link exchange is proportional to the number of links on the page. A link on a page with 100 other links is worth much less than a page with only 5 other links. Ideally, you should aim to get your links on pages with less than 20 other links on them.</li>\n<li>The text in your link and the surrounding text is important. Good link exchanges let you place a short text description next to your link.</li>\n<li>Some webmasters will place a link to you, then remove it a few weeks later. You should check your link every so often to ensure it is still active.</li>\n</ul>\n<br />\n<br />\nWe are interested in exchanging links with other websites that have content similar to ours. Please use the form below to begin this process.\n<br />\n<h2>Add Your Link</h2>\n[[formerrors.tpl]]            \n<br />\nWe may be interested in a link exchange with other well-maintained websites similar to ours. We prefer to exchange links with sites that are similar to ours, but will consider high quality websites on other topics that meet our Guidelines...\n<br />\n<br />\nWe feel our sites are of a high standard, and as such are only interested in sites of a similar quality.\n<br />\n<br />\nWe are <strong>only</strong> interested in links on pages that...\n<br />\n<ul>\n<li>Are designed for humans, not just search engines</li>\n<li>Are somewhat relevant to our site</li>\n<li>Are well spidered and indexed by search engines</li>\n<li>Will place our link within unique content</li>\n<li>Will place our link on pages with few other outgoing links, preferably less than 20</li>\n<li>Are not linking to low quality websites</li>\n</ul>\n<br />\nJust to be clear, and because we get hundreds of link exchange emails that don''t meet the above criteria, we are specifically <strong>not</strong> looking for...\n<br />\n<ul>\n<li>Link directories with hundreds of links per page</li>\n<li>Link directories where the design does not match the rest of the site</li>\n<li>Links on pages not spidered or indexed by the major search engines</li>\n<li>Links on sites covered with ads, or &quot;Made for Adsense&quot; sites</li>\n<li>Links on sites with no apparent uniqueness or value to offer</li>\n<li>Links on sites not related to ours</li>\n</ul>\n<br />\n<br />\n<strong>Important note:</strong>\n<br />\n<br />\nWe do automatic checks on your site every so often to ensure that our link is still active and working. We also review each site manually, so it may take a couple of days for your link to appear on the site.\n<br />\n<h4>Step 1: Please read the above guidelines</h4>\nIf you are unsure as to whether your links page could be considered &quot;quality&quot;, you might want to check out the <a href=\"http://www.ragepank.com/spam-o-meter/\" target=\"_BLANK\">spam-o-meter</a>.\n<br />\n<h4>Step 2: Add our link to your website</h4>\n<br />\n[[linktarget.tpl]]\n<br />\n<br />\n<strong>PLEASE edit</strong> the link description text so that it is NOT the same as the above -  as long as the basic message stays intact. Google does not like duplicate content.\n<br />\n<h4>Step 3: Enter your details so we can add your link</h4>\n[[linkform.tpl]]',
            pg_link='Jojo_Plugin_Jojo_link_exchange',
            pg_contentcache='no',
            pg_mainnav='no',
            pg_secondarynav='no',
            pg_footernav='no'
        ";
        Jojo::insertQuery( $insertQuery );
    } else {
        if ($data[0]['pg_url'] == '') {//Set pg_url to "lx" if empty
            echo "Set discovery level URL for <b>Link Exchange</b><br />";
            Jojo::updateQuery("UPDATE {page} SET pg_url='lx' WHERE pageid = ? LIMIT 1", array($data[0]['pageid']));
        }
    }
    //Edit Link Exchange
    $data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_url='admin/edit/linkexchange'");
    if (!count($data)) {
        echo "Adding <b>Edit Link Exchange</b> Page to menu<br />";
        Jojo::insertQuery("INSERT INTO {page} SET pg_title='Edit Link Exchange', pg_link='Jojo_Plugin_Admin_Edit', pg_url='admin/edit/linkexchange', pg_parent = ?, pg_order=30", array($_ADMIN_CONTENT_ID));
    }

    if (Jojo::tableExists('linkexchangecategory')) {
        //Edit Link Exchange Categories
        $data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_url='admin/edit/linkexchangecategory'");
        if (!count($data)) {
            echo "Adding <b>Edit Link Exchange Categories</b> Page to menu<br />";
            Jojo::insertQuery("INSERT INTO {page} SET pg_title='Edit Link Ex. Categories', pg_link='Jojo_Plugin_Admin_Edit', pg_url='admin/edit/linkexchangecategory', pg_parent = ?, pg_order=31", array($_ADMIN_CONTENT_ID));
        }
    }
}

/* add a Link Exchange page if one does not exist */
$data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_link='Jojo_Plugin_Jojo_link_exchange'");
if (count($data) == 0) {
    echo "Adding <b>Link Exchange</b> Page to menu<br />";
    $insertQuery = "
        INSERT INTO {page} SET
        pg_title='Sites of Interest',
        pg_url='lx',
        pg_body_code='[editor:bb]\n[[formerrors.tpl]]            \r\n[h2]Tutorial[/h2]\r\n\r\n[i]It is one thing to create relevant content, it is another thing to become [b]important[/b] relevant content in the eyes of the search engines. To help you understand about how links work, we put together this short tutorial:[/i]\r\n\r\nMost search engines consider the amount of incoming links to your website an important factor in determining your overall ranking. If many sites link to you, then the Search engines consider your site to be more important than other competing sites that don''t have any incoming links.\r\n\r\nIdeally, our content is so interesting and compelling that other webmasters will naturally want to link to it. Natural links are the best kind of links to have. They require no extra effort, are on other sites relevant to our topic and are given freely without requiring a reciprocal link (ie a link in return). It can take a long time to build natural links as good content takes time to prepare, and other webmasters will take time to find our sites and link to them.\r\n\r\nA popular way to build incoming links is Link Exchange. Many websites have a \"links\" page where they place links to other related websites. Reciprocal link building is approaching these webmasters and asking them to place a link to our site in return for us placing a link to them. It''s a topic of debate amongst SEO experts as to whether Reciprocal links are as effective as one way incoming links. While many agree that non-reciprocal links are best, it is also clear that reciprocal links (if done correctly) will help with your Page Rank and Search Engine Position.\r\n\r\nWhen choosing sites to exchange links with, there are a few things to keep in mind:\r\n[list]\r\n[*]Incoming links are most valuable on pages that are related to your content.\r\n[*]Do not link to any site that has been banned by Google (or other Search Engines), or looks like it''s spam (which may be banned in the future). If you link to a banned site, this can negatively effect your ranking.\r\n[*]Links from pages with a high PageRank are more valuable to you than pages with little or no PageRank. You can use the Google Toolbar to check the pagerank of any page on the web. While PageRank is important, it''s only a small part of the equation. Keep in mind that PageRank is only updated every 3 months (approx) so the Google Toolbar is not always an accurate reflection of this (especially on new websites).\r\n[*]The value you get from a link exchange is proportional to the number of links on the page. A link on a page with 100 other links is worth much less than a page with only 5 other links. Ideally, you should aim to get your links on pages with less than 20 other links on them.\r\n[*]The text in your link and the surrounding text is important. Good link exchanges let you place a short text description next to your link.\r\n[*]Some webmasters will place a link to you, then remove it a few weeks later. You should check your link every so often to ensure it is still active.\r\n[/list]\r\n\r\nWe are interested in exchanging links with other websites that have content similar to ours. Please use the form below to begin this process.\r\n\r\n[h2]Add Your Link[/h2]\r\nWe may be interested in a link exchange with other well-maintained websites similar to ours. We prefer to exchange links with sites that are similar to ours, but will consider high quality websites on other topics that meet our Guidelines...\r\n\r\nWe feel our sites are of a high standard, and as such are only interested in sites of a similar quality.\r\n\r\nWe are [b]only[/b] interested in links on pages that...\r\n[list]\r\n[*]Are designed for humans, not just search engines\r\n[*]Are somewhat relevant to our site\r\n[*]Are well spidered and indexed by search engines\r\n[*]Will place our link within unique content\r\n[*]Will place our link on pages with few other outgoing links, preferably less than 20\r\n[*]Are not linking to low quality websites\r\n[/list]\r\nJust to be clear, and because we get hundreds of link exchange emails that don''t meet the above criteria, we are specifically [b]not[/b] looking for...\r\n[list]\r\n[*]Link directories with hundreds of links per page\r\n[*]Link directories where the design does not match the rest of the site\r\n[*]Links on pages not spidered or indexed by the major search engines\r\n[*]Links on sites covered with ads, or \"Made for Adsense\" sites\r\n[*]Links on sites with no apparent uniqueness or value to offer\r\n[*]Links on sites not related to ours\r\n[/list]\r\n\r\n[b]Important note:[/b]\r\n\r\nWe do automatic checks on your site every so often to ensure that our link is still active and working. We also review each site manually, so it may take a couple of days for your link to appear on the site.\r\n\r\n[h4]Step 1: Please read the above guidelines[/h4]\r\nIf you are unsure as to whether your links page could be considered \"quality\", you might want to check out the [url=http://www.ragepank.com/spam-o-meter/]spam-o-meter[/url].\r\n\r\n[h4]Step 2: Add our link to your website[/h4]\r\n\r\n[[linktarget.tpl]]\r\n\r\n[b]PLEASE edit[/b] the link description text so that it is NOT the same as the above - as long as the basic message stays intact. Google does not like duplicate content.\r\n\r\n[h4]Step 3: Enter your details so we can add your link[/h4]\r\n[[linkform.tpl]]',
        pg_body='\n<h2>Tutorial</h2>\n<br />\n<em>It is one thing to create relevant content, it is another thing to become <strong>important</strong> relevant content in the eyes of the search engines. To help you understand about how links work, we put together this short tutorial:</em>\n<br />\n<br />\nMost search engines consider the amount of incoming links to your website an important factor in determining your overall ranking. If many sites link to you, then the Search engines consider your site to be more important than other competing sites that don''t have any incoming links.\n<br />\n<br />\nIdeally, our content is so interesting and compelling that other webmasters will naturally want to link to it. Natural links are the best kind of links to have. They require no extra effort, are on other sites relevant to our topic and are given freely without requiring a reciprocal link (ie a link in return). It can take a long time to build natural links as good content takes time to prepare, and other webmasters will take time to find our sites and link to them.\n<br />\n<br />\nA popular way to build incoming links is Link Exchange. Many websites have a &quot;links&quot; page where they place links to other related websites. Reciprocal link building is approaching these webmasters and asking them to place a link to our site in return for us placing a link to them. It''s a topic of debate amongst SEO experts as to whether Reciprocal links are as effective as one way incoming links. While many agree that non-reciprocal links are best, it is also clear that reciprocal links (if done correctly) will help with your Page Rank and Search Engine Position.\n<br />\n<br />\nWhen choosing sites to exchange links with, there are a few things to keep in mind:\n<br />\n<ul>\n<li>Incoming links are most valuable on pages that are related to your content.</li>\n<li>Do not link to any site that has been banned by Google (or other Search Engines), or looks like it''s spam (which may be banned in the future). If you link to a banned site, this can negatively effect your ranking.</li>\n<li>Links from pages with a high PageRank are more valuable to you than pages with little or no PageRank. You can use the Google Toolbar to check the pagerank of any page on the web. While PageRank is important, it''s only a small part of the equation. Keep in mind that PageRank is only updated every 3 months (approx) so the Google Toolbar is not always an accurate reflection of this (especially on new websites).</li>\n<li>The value you get from a link exchange is proportional to the number of links on the page. A link on a page with 100 other links is worth much less than a page with only 5 other links. Ideally, you should aim to get your links on pages with less than 20 other links on them.</li>\n<li>The text in your link and the surrounding text is important. Good link exchanges let you place a short text description next to your link.</li>\n<li>Some webmasters will place a link to you, then remove it a few weeks later. You should check your link every so often to ensure it is still active.</li>\n</ul>\n<br />\n<br />\nWe are interested in exchanging links with other websites that have content similar to ours. Please use the form below to begin this process.\n<br />\n<h2>Add Your Link</h2>\n[[formerrors.tpl]]            \n<br />\nWe may be interested in a link exchange with other well-maintained websites similar to ours. We prefer to exchange links with sites that are similar to ours, but will consider high quality websites on other topics that meet our Guidelines...\n<br />\n<br />\nWe feel our sites are of a high standard, and as such are only interested in sites of a similar quality.\n<br />\n<br />\nWe are <strong>only</strong> interested in links on pages that...\n<br />\n<ul>\n<li>Are designed for humans, not just search engines</li>\n<li>Are somewhat relevant to our site</li>\n<li>Are well spidered and indexed by search engines</li>\n<li>Will place our link within unique content</li>\n<li>Will place our link on pages with few other outgoing links, preferably less than 20</li>\n<li>Are not linking to low quality websites</li>\n</ul>\n<br />\nJust to be clear, and because we get hundreds of link exchange emails that don''t meet the above criteria, we are specifically <strong>not</strong> looking for...\n<br />\n<ul>\n<li>Link directories with hundreds of links per page</li>\n<li>Link directories where the design does not match the rest of the site</li>\n<li>Links on pages not spidered or indexed by the major search engines</li>\n<li>Links on sites covered with ads, or &quot;Made for Adsense&quot; sites</li>\n<li>Links on sites with no apparent uniqueness or value to offer</li>\n<li>Links on sites not related to ours</li>\n</ul>\n<br />\n<br />\n<strong>Important note:</strong>\n<br />\n<br />\nWe do automatic checks on your site every so often to ensure that our link is still active and working. We also review each site manually, so it may take a couple of days for your link to appear on the site.\n<br />\n<h4>Step 1: Please read the above guidelines</h4>\nIf you are unsure as to whether your links page could be considered &quot;quality&quot;, you might want to check out the <a href=\"http://www.ragepank.com/spam-o-meter/\" target=\"_BLANK\">spam-o-meter</a>.\n<br />\n<h4>Step 2: Add our link to your website</h4>\n<br />\n[[linktarget.tpl]]\n<br />\n<br />\n<strong>PLEASE edit</strong> the link description text so that it is NOT the same as the above -  as long as the basic message stays intact. Google does not like duplicate content.\n<br />\n<h4>Step 3: Enter your details so we can add your link</h4>\n[[linkform.tpl]]',
        pg_link='Jojo_Plugin_Jojo_link_exchange',
        pg_contentcache='no',
        pg_mainnav='no',
        pg_secondarynav='no',
        pg_footernav='no'
    ";
    Jojo::insertQuery( $insertQuery );
}

/* Remove the previous link-exchange request page from menu if it exists. */
$data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_link='Jojo_Plugin_Jojo_link_exchange' and pg_url='lx-request'");
if (count($data) != 0) {
    echo "Transferring Link Exchange tutorial text from existing lx-request page to lx page<br />";
    Jojo::updateQuery("UPDATE {page} SET pg_body = ?, pg_body_code = ? WHERE pg_link='Jojo_Plugin_Jojo_link_exchange' and pg_url='lx'", array($data[0]['pg_body'], $data[0]['pg_body_code']));
    echo "Removing <b>Request Link Exchange</b> Page from menu<br />";
    Jojo::deleteQuery("DELETE FROM {page} WHERE pg_link='Jojo_Plugin_Jojo_link_exchange' and pg_url='lx-request'");
}

