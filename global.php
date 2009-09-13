<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007 Harvey Kane <code@ragepank.com>
 * Copyright 2007 Michael Holt <code@gardyneholt.co.nz>
 * Copyright 2007 Melanie Schulz <mel@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Harvey Kane <code@ragepank.com>
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @author  Melanie Schulz <mel@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

if (!defined('_LINKTEXT'))             define('_LINKTEXT',             Jojo::getOption('linktext'));
if (!defined('_LINKBODY'))             define('_LINKBODY',             Jojo::getOption('linkbody'));
if (!defined('_LINKTARGET'))           define('_LINKTARGET',           Jojo::either(Jojo::getOption('linktarget'), _SITEURL));
if (!defined('_LIVEURL'))              define('_LIVEURL',              Jojo::either(Jojo::getOption('liveurl'), _SITEURL));
if (!defined('_LINKDIRECT'))           define('_LINKDIRECT',           Jojo::getOption('linkdirect'));
if (!defined('_DIRECTORYNAME'))        define('_DIRECTORYNAME',        Jojo::either(Jojo::getOption('directoryname'),"directory"));
if (!defined('_DIRECTORYLISTINGNAME')) define('_DIRECTORYLISTINGNAME', Jojo::either(Jojo::getOption('directorylistingname'), 'directory-listing'));

$smarty->assign('linktext',         Jojo::getOption('linktext'));
$smarty->assign('linkbody',         Jojo::getOption('linkbody'));
$smarty->assign('linktarget',       Jojo::getOption('linktarget'));
$smarty->assign('BASE_PHP_SELF',    basename($_SERVER['PHP_SELF']));
