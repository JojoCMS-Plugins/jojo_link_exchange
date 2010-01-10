<?php

class JOJO_Plugin_Jojo_link_exchange extends JOJO_Plugin
{


function postLink()
    {
        /* Check for form injection attempts */
        Jojo::noFormInjection();

        global $smarty;
        $errors = array();
        /* Get variables */
        $name =              Util::getFormData('name', '');
        $email =             Util::getFormData('email', '');
        $url =               Util::getFormData('url', '');
        $linktitle =         Util::getFormData('linktitle', '');
        $description =       Util::getFormData('description', '');
        $reciprocalurl =     Util::getFormData('reciprocalurl', '');
        $captchacode =       Util::getFormData('captchacode', '');

        $url = ($url != '') ? Jojo::addhttp($url) : '';
        $reciprocalurl = $reciprocalurl != '' ? Jojo::addhttp($reciprocalurl) : '';

        if (!PhpCaptcha::Validate($captchacode)) {
            $errors[] = 'Invalid code entered';
        }

        /* error checking */
        if ($name == '')                                                     $errors[] = 'Please enter your name';
        if ($url == '')                                                      $errors[] = 'Please enter a url';
//        if ($reciprocalurl == '')                                            $errors[] = 'Please enter a reciprocal url';
        if ($description == '')                                              $errors[] = 'Please enter a description';
        if ($linktitle == '')                                                $errors[] = 'Please enter a title';
        if (($email != '') && !Jojo::checkEmailFormat($email))               $errors[] = 'Email format is invalid';
        if (($url != '') && !Jojo::checkUrlFormat($url))                     $errors[] = 'URL format is invalid';
        if (($reciprocalurl != '') && !Jojo::checkUrlFormat($reciprocalurl)) $errors[] = 'Reciprocal URL format is invalid';


        if (!count($errors)) {
            /* Success */
            $approvecode = sha1(Jojo::randomString(30));
            $deletecode  = sha1(Jojo::randomString(30));

            // Check the database to see if this link already exists.
            $urlExists = false;
            $reciprocalurlExists = false;
            $urlScan = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_url=?", array($url));
            $reciprocalurlScan = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_reciprocalurl=?", array($reciprocalurl));
            if (count($urlScan)) {
                $urlExists = true;
            }
            if (count($reciprocalurlScan)) {
                $reciprocalurlExists = true;
            }

            Jojo::insertQuery("INSERT INTO {linkexchange} SET lx_name=?, lx_linktext=?, lx_url=?, lx_reciprocalurl=?, lx_desc=?, lx_webmastername=?, lx_webmasteremail=?, lx_active='no', lx_priority='low', lx_approvecode=?, lx_deletecode=?, lx_dateadded = now() ", array($linktitle, $linktitle, $url, $reciprocalurl, $description, $name, $email, $approvecode, $deletecode));
            $_SESSION['name']    = $name;
            $_SESSION['email']   = $email;
            $_SESSION['website'] = $url;

            $message  = "A link exchange request has been submitted on "._SITEURL."\n\n";
            $message .= "Submitted by: ".$name."\n";
            $message .= $email != '' ? "Email: ".$email."\n" : '';
            $message .= $linktitle != '' ? "Title: ".$linktitle."\n" : '';
            $message .= $description != '' ? "Description: ".$description."\n" : '';
            $message .= $url != '' ? "URL: ".$url."\n" : '';
            $message .= $reciprocalurl != '' ? "Reciprocal URL: ".$reciprocalurl."\n" : '';
            if ($urlExists && $reciprocalurlExists) {
                $message .= "\nWARNING:  Both the URL and the Reciprocal URL exist in the link exchange database.\n";
            } elseif ($urlExists){
                $message .= "\nWARNING:  The URL already exists in the link exchange database.\n";
            } elseif ($reciprocalurlExists){
                $message .= "\nWARNING:  The Reciprocal URL already exists in the link exchange database.\n";
            }
            $message .= "\n\nTo APPROVE this exchange, click the following link\n";
            $message .= _SITEURL.'/lx-admin/'.$approvecode."/\n\n";
            $message .= "To DELETE this exchange, click the following link\n";
            $message .= _SITEURL.'/lx-admin/'.$deletecode."/\n";

            $message .= Jojo::emailFooter();

            /* Email to webmaster */
            $linkManagerName = Jojo::either(Jojo::getOption('linkmanagername'), _WEBMASTERNAME);
            $linkManagerAddress = Jojo::either(Jojo::getOption('linkmanageraddress'), _WEBMASTERADDRESS);
            Jojo::simplemail($linkManagerName, $linkManagerAddress, 'Link Exchange Request - '._SITETITLE, $message, $name, $email);
            Jojo::redirect($this->getCorrectUrl(), 302);
        } else {
            /* Error */
            $smarty->assign('error',         implode("<br />\n", $errors));
            $smarty->assign('name',          $name);
            $smarty->assign('email',         $email);
            $smarty->assign('url',           $url);
            $smarty->assign('reciprocalurl', $reciprocalurl);
            $smarty->assign('linktitle',     $linktitle);
            $smarty->assign('description',   $description);
            return false;
        }

    }


    function _getContent()
    {

        global $smarty, $templateoptions;
        $content = array();

        $sites = array();
        include(dirname(__FILE__).'/jojo_link_exchange_sites.php');

        $displaysites = array();
        $mysite = '';
        foreach ($sites as $name => $site) {
            if ($site['url'] == _LIVEURL) {
              $mysite = $name;
              break;
              }
        }
        $mygroup = isset($sites[$mysite]['group']) ? $sites[$mysite]['group'] : 'a';
        $displaysites = array();
        foreach ($sites as $name => $site) {
            $site['description'] = $site['description'][Jojo::semiRand(0, count($site['description'])-1, $site['url'])];
            if ( ($mygroup == 'a') && (($site['group'] == 'b') || ($site['group'] == 'c')) ) {
              $displaysites[] = $site;
            }
            if ( ($mygroup == 'b') && (($site['group'] == 'c') || ($site['group'] == 'd')) ) {
              $displaysites[] = $site;
            }
            if ( ($mygroup == 'c') && (($site['group'] == 'd') || ($site['group'] == 'a')) ) {
              $displaysites[] = $site;
            }
            if ( ($mygroup == 'd') && (($site['group'] == 'a') || ($site['group'] == 'b')) ) {
              $displaysites[] = $site;
            }
            if ( ($mygroup == 'x') && ($site['group'] == 'x') && ($name != $mysite) ) {
              $displaysites[] = $site;
            }
        }

        /* This semi-randomises the array on each site. This will change as sites are added to the list, but not too often */
        srand(Jojo::semiRand(0, 1000));
        shuffle($displaysites);

        $smarty->assign('sites', $displaysites);

        $id     = Util::getFormData('id', 0);
        $action = Util::getFormData('action', '');

        if (isset($_POST['submit'])) {
            $errors = !$this->postLink();
        }

        $linkexchangecategorys = Jojo::selectQuery("SELECT * FROM {linkexchangecategory} WHERE lc_parent=0 ORDER BY lc_order, lc_name");
        $n = count($linkexchangecategorys);
        for ($i=0; $i<$n; $i++) {
            $linkexchangecategorys[$i]['url'] = Jojo::rewrite(_DIRECTORYNAME, $linkexchangecategorys[$i]['linkexchangecategoryid'], $linkexchangecategorys[$i]['lc_name'], '');
        }
        $smarty->assign('linkexchangecategorys', $linkexchangecategorys);


        /* Link Exchange Admin */
        if ($action == 'lx-admin') {
            $code = Util::getFormData('code', false);

            if (!$code) exit();

            $active = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_approvecode = ? AND lx_active = 'no'", $code);
            $n = count($active);
            for ($i=0; $i<$n; $i++) {
                Jojo::updateQuery("UPDATE {linkexchange} SET lx_active = 'yes' WHERE lx_approvecode = ?", $code);
                echo "Updating " . $active[$i]['lx_url']." to active<br />
                Please move the link to the appropriate category via admin of the <a href='../../"._ADMIN."/edit/linkexchange/".$active[$i]['linkexchangeid']."/'>Link Exchange</a><br />
                ";

                /* email the webmaster */
                $message = "This is an automated message from "._SITEURL . "\n\n";
                $message .= "We have just approved a link exchange request with " . $active[$i]['lx_url']." that was submitted recently by " . $active[$i]['lx_webmastername'].".\n\n";
                if(_LINKDIRECT != "yes") {
                    $message .= "You will find your link on the following page...\n";
                    $message .= _SITEURL . '/'. Jojo::rewrite(_DIRECTORYLISTINGNAME,$active[$i]['linkexchangeid'],$active[$i]['lx_name'],'') . "\n\n";
                    $message .= "Because the page has just been created, it has no PageRank, however your link is the only external link on the page, and the page will usually get indexed by Google fairly quickly.\n\n";
                } else {
                    $message .= "You will find your link on the appropriate category of the following page...\n";
                    $message .=_SITEURL . "/lx/\n\n";

                }
                $message .= "We do periodically check our links to ensure they are still active, so we would appreciate it if you can ensure our link remains on your site.\n\n";
                $message .= "Thanks for the exchange,\n\n"._WEBMASTERNAME . "\nWebmaster, "._SITETITLE;

                Jojo::simplemail($active[$i]['lx_webmastername'], $active[$i]['lx_webmasteremail'], 'Link Exchange Request approved - '._SITETITLE, $message);
                Jojo::simplemail(_WEBMASTERNAME, _WEBMASTERADDRESS, 'COPY - Link Exchange Request approved - '._SITETITLE, $message,$active[$i]['lx_webmastername'], $active[$i]['lx_webmasteremail']);
            }

            $delete = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_deletecode = ?", $code);
            for ($i=0; $i<count($delete); $i++) {
                Jojo::deleteQuery("DELETE FROM {linkexchange} WHERE lx_deletecode = ?", $code);
                echo "Deleting " . $delete[$i]['lx_url']." from link exchange<br />";
                //email the webmaster?
            }

            if (!count($active) && !count($delete)) {
                echo 'No matching link exchanges were found. This link exchange may have already been deleted.<br />
                Where applicable, please move the link to the appropriate <a href="../../'._ADMIN.'/edit/linkexchange/">Link Exchange</a> category.';
            }
            exit();


        } elseif ($action == _DIRECTORYNAME) {

            $this->qt = 'linkexchangecategory';
            $this->qid = $id;

            $where = " AND lx_categoryid = ?";
            $categorys = Jojo::selectQuery("SELECT * FROM {linkexchangecategory} WHERE linkexchangecategoryid=? LIMIT 1", $id);
            $category = $categorys[0];

            /* add breadcrumb */
            $breadcrumbs = $this->_getBreadcrumbs();
            $breadcrumb = array();
            $breadcrumb['name']               = $category['lc_name'];
            $breadcrumb['rollover']           = $category['lc_name'];
            $breadcrumb['url']                =  Jojo::rewrite(_DIRECTORYNAME, $category['linkexchangecategoryid'], $category['lc_name'], '');
            $breadcrumbs[count($breadcrumbs)] = $breadcrumb;
            $content['breadcrumbs']           = $breadcrumbs;

            $content['seotitle']              =  Jojo::either($category['lc_seotitle'], $category['lc_name']);
            $content['title']                 = $category['lc_name'];
            $smarty->assign('category', $category);
            $linkexchanges = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_active='yes' ".$where."", array($id));

            if(_LINKDIRECT != "yes") {
              $n = count($linkexchanges);
              for ($i=0;$i<$n;$i++) {
                  $linkexchanges[$i]['internalurl'] = Jojo::rewrite(_DIRECTORYLISTINGNAME, $linkexchanges[$i]['linkexchangeid'], $linkexchanges[$i]['lx_name'], '');
              }
            }

            $linkdirect = (_LINKDIRECT=="yes") ? "lx_url": "internalurl";
            $smarty->assign('linkdirect', $linkdirect);

            $smarty->assign('linkexchanges', $linkexchanges);

            $content['content'] = $smarty->fetch('jojo_link_exchange.tpl');


        } elseif ($action == _DIRECTORYLISTINGNAME) {
            $this->qt = 'linkexchange';
            $this->qid = $id;

            $linkexchanges = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_active='yes' AND linkexchangeid=? LIMIT 1", $id);
            if (!count($linkexchanges)) {
                $content['header']=404;
                $content['content'] = 'This link exchange does not exist';
            } else {
                $linkexchange = $linkexchanges[0];
                $categoryid = $linkexchange['lx_categoryid'];

                $content['seotitle'] =  Jojo::either($linkexchange['lx_linktext'], $linkexchange['lx_name']);
                $content['title'] = $linkexchange['lx_name'];
                $smarty->assign('linkexchange', $linkexchange);

                /* get data on category */
                $where = " AND lx_categoryid = ?";
                $categorys = Jojo::selectQuery("SELECT * FROM {linkexchangecategory} WHERE linkexchangecategoryid=? LIMIT 1", $categoryid);
                $category = $categorys[0];
                $smarty->assign('category', $category);

                $breadcrumbs = $this->_getBreadcrumbs();

                /* add breadcrumb for category */
                $breadcrumb = array();
                $breadcrumb['name']     = $category['lc_name'];
                $breadcrumb['rollover'] = $category['lc_name'];
                $breadcrumb['url']      =  Jojo::rewrite(_DIRECTORYNAME, $category['linkexchangecategoryid'], $category['lc_name'], '');
                $breadcrumbs[count($breadcrumbs)] = $breadcrumb;

                /* add breadcrumb for linkexchange */
                $breadcrumb = array();
                $breadcrumb['name']     = $linkexchange['lx_name'];
                $breadcrumb['rollover'] = $linkexchange['lx_linktext'];
                $breadcrumb['url']      =  Jojo::rewrite(_DIRECTORYLISTINGNAME, $linkexchange['linkexchangeid'], $linkexchange['lx_name'], '');
                $breadcrumbs[count($breadcrumbs)] = $breadcrumb;

                /* similar links */
                $similarlinkexchanges = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_active='yes' ".$where." ORDER BY RAND()", array($id));
                $n = count($similarlinkexchanges);
                for ($i=0; $i<$n; $i++) {
                    $similarlinkexchanges[$i]['internalurl'] =  Jojo::rewrite(_DIRECTORYLISTINGNAME, $similarlinkexchanges[$i]['linkexchangeid'], $similarlinkexchanges[$i]['lx_name'], '');
                }
                $smarty->assign('similarlinkexchanges', $similarlinkexchanges);
                $content['content'] = $smarty->fetch('jojo_link_exchange.tpl');
                $content['breadcrumbs'] = $breadcrumbs;
            }
        } else {
            /* Link Exchange Homepage */
            $linkexchanges = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_priority='high'");

            if(_LINKDIRECT != "yes") {
              $n = count($linkexchanges);
              for ($i=0;$i<$n;$i++) {
                  $linkexchanges[$i]['internalurl'] = Jojo::rewrite(_DIRECTORYLISTINGNAME, $linkexchanges[$i]['linkexchangeid'], $linkexchanges[$i]['lx_name'], '');
              }
            }

            $linkdirect = (_LINKDIRECT=="yes") ? "lx_url": "internalurl";
            $smarty->assign('linkdirect', $linkdirect);

            $smarty->assign('linkexchangehome', true);
            $smarty->assign('linkexchanges', $linkexchanges);
            $smarty->assign('content', $this->page['pg_body']);

            $content['content'] = $smarty->fetch('jojo_link_exchange.tpl');
        }

        return $content;
    }

    function sitemap($sitemap)
    {
        $linkexchangetree = new hktree();
        $linkexchangetree->addNode('index', 0, 'Directory Index', 'lx/');
        $limit = 20; //If there are more than x link exchanges, only show the categories

        /* Categories */
        $linkexchangecategorys = Jojo::selectQuery("SELECT * FROM {linkexchangecategory} WHERE lc_parent=0 ORDER BY lc_order, lc_name");
        $n = count($linkexchangecategorys);
        for ($i=0; $i<$n; $i++) {
            $linkexchangecategorys[$i]['url'] = Jojo::rewrite(_DIRECTORYNAME, $linkexchangecategorys[$i]['linkexchangecategoryid'], $linkexchangecategorys[$i]['lc_name'],'');
            $linkexchangetree->addNode($linkexchangecategorys[$i]['linkexchangecategoryid'], 0, $linkexchangecategorys[$i]['lc_name'], $linkexchangecategorys[$i]['url']);
        }

        /* Link Exchanges */
        if(_LINKDIRECT != 'yes'){
        $linkexchanges = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_active='yes' ORDER BY lx_name");
        $n = count($linkexchanges);
        if ($n < $limit) {
            for ($i=0; $i<$n; $i++) {
                $linkexchanges[$i]['url'] =  Jojo::rewrite(_DIRECTORYLISTINGNAME, $linkexchanges[$i]['linkexchangeid'], $linkexchanges[$i]['lx_name'], '');
                $linkexchangetree->addNode('lx'.$linkexchanges[$i]['linkexchangeid'], $linkexchanges[$i]['lx_categoryid'], $linkexchanges[$i]['lx_name'], $linkexchanges[$i]['url']);
            }
        }
        }
        /* Remove any other links to the articles section form the sitemap */
        foreach($sitemap as $k => $section) {
            $sitemap[$k]['tree'] = JOJO_Plugin_Jojo_link_exchange::_sitemapRemoveSelf($section['tree']);
        }

        /* Add to the sitemap array */
        $sitemapsection = array();
        $sitemapsection['title']  = 'Directory';
        $sitemapsection['tree']   = $linkexchangetree->asArray();
        $sitemapsection['order']  = 9;
        $sitemapsection['header'] = '';
        $sitemapsection['footer'] = '';
        $sitemap['directory']     = $sitemapsection;

        return $sitemap;
    }

    function _sitemapRemoveSelf($tree)
    {
        foreach ($tree as $k =>$t) {
            if ($t['url'] == 'lx/') {
                unset($tree[$k]);
            } else {
                $tree[$k]['children'] = JOJO_Plugin_Jojo_link_exchange::_sitemapRemoveSelf($t['children']);
            }
        }
        return $tree;
    }

    function xmlSitemap($sitemap)
    {
        /* categories */
        $data = Jojo::selectQuery("SELECT * FROM {linkexchangecategory} WHERE 1");
        $n = count($data);
        for ($i=0; $i<$n; $i++) {
            $url           = _SITEURL . '/'. Jojo::rewrite(_DIRECTORYNAME, $data[$i]['linkexchangecategoryid'], $data[$i]['lc_name'], '');
            $lastmod       = 0;
            $priority      = 0.4;
            $sitemap[$url] = array($url, $lastmod, 'monthly', $priority);
        }

        /* exchanges */
        if(_LINKDIRECT != 'yes'){
        $data = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_active='yes'");
        $n = count($data);
        for ($i=0; $i<$n; $i++) {
            $url           = _SITEURL . '/'. Jojo::rewrite(_DIRECTORYLISTINGNAME, $data[$i]['linkexchangeid'], $data[$i]['lx_name'],'');
            $lastmod       = 0;
            $priority      = 0.1;
            $sitemap[$url] = array($url, $lastmod, 'monthly', $priority);
        }
        }
        return $sitemap;

    }

    function getCorrectUrl()
    {

        $id = Util::getFormData('id', 0);
        $action = Util::getFormData('action', 'lx');

        if($action=="directory" and _DIRECTORYNAME != "directory") $action = _DIRECTORYNAME;
        if($action=="directory-listing" and _DIRECTORYLISTINGNAME != "directory-listing") $action = _DIRECTORYLISTINGNAME;

        if ($action == 'lx-admin' || $action == 'lx-request') {
            return _PROTOCOL.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        } elseif ($action == _DIRECTORYNAME) {
            $categories = Jojo::selectQuery("SELECT * FROM {linkexchangecategory} WHERE linkexchangecategoryid=? LIMIT 1", $id);
            $expectedurl = _SITEURL.'/'. Jojo::rewrite(_DIRECTORYNAME, $categories[0]['linkexchangecategoryid'], $categories[0]['lc_name'],'');
        } elseif ($action == _DIRECTORYLISTINGNAME) {
            $linkexchanges = Jojo::selectQuery("SELECT * FROM {linkexchange} WHERE lx_active='yes' AND linkexchangeid=? LIMIT 1", $id);
            $expectedurl = _SITEURL.'/'. Jojo::rewrite(_DIRECTORYLISTINGNAME, $linkexchanges[0]['linkexchangeid'], $linkexchanges[0]['lx_name'], '');
            if(!$linkexchanges[0]['linkexchangeid']) $expectedurl=_PROTOCOL.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        } else {
            return parent::getCorrectUrl();
        }
        return $expectedurl;
    }

}
