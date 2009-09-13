<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007-2008 Harvey Kane <code@ragepank.com>
 * Copyright 2007-2008 Michael Holt <code@gardyneholt.co.nz>
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
if (!defined('_DIRECTORYNAME'))        define('_DIRECTORYNAME',        Jojo::either(Jojo::getOption('directoryname'),"directory"));
if (!defined('_DIRECTORYLISTINGNAME')) define('_DIRECTORYLISTINGNAME', Jojo::either(Jojo::getOption('directorylistingname'), 'directory-listing'));
if (!defined('_LINKDIRECT'))           define('_LINKDIRECT',           Jojo::getOption('linkdirect'));

$_provides['pluginClasses'] = array(
        'Jojo_Plugin_Jojo_link_exchange' => 'Link Exchange system'
        );

/* Register URI patterns */
if(_DIRECTORYNAME<>"directory")
  Jojo::registerURI("[action:directory]/[id:integer]/[string]",         'Jojo_Plugin_Jojo_link_exchange'); // "directory/123/name-of-category/"

if(_LINKDIRECT<>'yes'){
  if(_DIRECTORYLISTINGNAME<>"directory-listing")
    Jojo::registerURI("[action:directory-listing]/[id:integer]/[string]", 'Jojo_Plugin_Jojo_link_exchange'); // "directory-listing/123/name-of-site/"
}

Jojo::registerURI("[action:"._DIRECTORYNAME."]/[id:integer]/[string]",         'Jojo_Plugin_Jojo_link_exchange'); // "directory/123/name-of-category/"

if(_LINKDIRECT<>'yes'){
  Jojo::registerURI("[action:"._DIRECTORYLISTINGNAME."]/[id:integer]/[string]", 'Jojo_Plugin_Jojo_link_exchange'); // "directory-listing/123/name-of-site/"
}

Jojo::registerURI("[action:lx-admin]/[code:[a-f0-9]{40}]",            'Jojo_Plugin_Jojo_link_exchange'); // "lx-admin/8o6vg53i763496t396fgt9tfg98g/"

/* Sitemap filter */
Jojo::addFilter('jojo_sitemap', 'sitemap', 'jojo_link_exchange');

/* XML filter */
Jojo::addFilter('jojo_xml_sitemap', 'xmlsitemap', 'jojo_link_exchange');

$_options[] = array(
    'id'          => 'linktarget',
    'category'    => 'Directory',
    'label'       => 'Link Target URL',
    'description' => 'The URL that a site requesting a link exchange should link to (ie to allow for 3 way links).',
    'type'        => 'text',
    'default'     => '',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'linktext',
    'category'    => 'Directory',
    'label'       => 'Link text',
    'description' => 'The preferred link text you would like people to use when they link to the site.',
    'type'        => 'text',
    'default'     => '',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'linkbody',
    'category'    => 'Directory',
    'label'       => 'Link body text',
    'description' => 'A one sentence description of the site used for link exchanges.',
    'type'        => 'text',
    'default'     => '',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'linkmanagername',
    'category'    => 'Directory',
    'label'       => 'Link Manager Name',
    'description' => 'The name of the person handling link requests.',
    'type'        => 'text',
    'default'     => '',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'linkmanageraddress',
    'category'    => 'Directory',
    'label'       => 'Link Manager email',
    'description' => 'The email address of the person handling link requests.',
    'type'        => 'text',
    'default'     => '',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'liveurl',
    'category'    => 'Site',
    'label'       => 'Live URL',
    'description' => '(optional) On development servers, set this option to the Live URL of the site for some functions to work correctly.',
    'type'        => 'text',
    'default'     => '',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'linkdirect',
    'category'    => 'Directory',
    'label'       => 'Direct Link to sites?',
    'description' => 'A direct link, or a specific page for each partner that links to them.',
    'type'        => 'radio',
    'default'     => 'yes',
    'options'     => 'yes,no',
);

$_options[] = array(
    'id'          => 'directoryname',
    'category'    => 'Directory',
    'label'       => 'Directory name',
    'description' => 'The url of the directory',
    'type'        => 'text',
    'default'     => 'directory',
    'options'     => '',
);

$_options[] = array(
    'id'          => 'directorylistingname',
    'category'    => 'Directory',
    'label'       => 'Directory listing name',
    'description' => 'If directory listings are not direct, the url of the individual listings',
    'type'        => 'text',
    'default'     => 'directory-listing',
    'options'     => '',
);