<?php
/**
 *
 * autoupdate_article.inc.php
 *
 * Default Tabledata and Fielddata settings
 *
 * @version x
 * @copyright 2005 Harvey Kane
 * @author Harvey Kane
 *
 **/

$table = 'linkexchange';
$o = 1;

$default_td[$table]['td_displayname']   = 'Link Exchange';
$default_td[$table]['td_displayfield']  = 'lx_name';
$default_td[$table]['td_rolloverfield'] = 'lx_url';
$default_td[$table]['td_orderbyfields'] = 'lx_name';
$default_td[$table]['td_topsubmit']     = 'yes';
$default_td[$table]['td_deleteoption']  = 'yes';
$default_td[$table]['td_menutype']      = 'list';
$default_td[$table]['td_categoryfield'] = 'lx_categoryid';
$default_td[$table]['td_categorytable'] = 'linkexchangecategory';
$default_td[$table]['td_help']          = '';
$default_td[$table]['td_activefield']   = 'lx_active';

/* ID */
$field = 'linkexchangeid';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'A unique ID, automatically assigned by the system';
$default_fd[$table][$field]['fd_mode'] = 'standard';


/* Date Added */
$field = 'lx_dateadded';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'Date that the link was submitted';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* Last mod */
$field = 'lx_lastmod';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'Date that the link was last updated';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* Name */
$field = 'lx_name';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_size'] = '40';
$default_fd[$table][$field]['fd_help'] = 'The name of the site or company that is being linked to';
$default_fd[$table][$field]['fd_mode'] = 'basic';

/* Link Text */
$field = 'lx_linktext';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_name'] = 'Link Text';
$default_fd[$table][$field]['fd_required'] = 'no';
$default_fd[$table][$field]['fd_size'] = '40';
$default_fd[$table][$field]['fd_help'] = 'The clickable text of the link - this should match the targeted search phrase for maximum search engine benefit';
$default_fd[$table][$field]['fd_mode'] = 'basic';

/* URL */
$field = 'lx_url';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'url';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_size'] = '40';
$default_fd[$table][$field]['fd_help'] = 'The page you are linking to. Normally their homepage. Please include the http://';
$default_fd[$table][$field]['fd_mode'] = 'basic';

/* Reciprocal URL */
$field = 'lx_reciprocalurl';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'url';
$default_fd[$table][$field]['fd_name'] = 'Reciprocal URL';
$default_fd[$table][$field]['fd_required'] = 'no';
$default_fd[$table][$field]['fd_size'] = '40';
$default_fd[$table][$field]['fd_help'] = 'The page where your link is hosted. Completing this field allows us to track the link and ensure it remains active. Please include the http://';
$default_fd[$table][$field]['fd_mode'] = 'basic';

/* Description */
$field = 'lx_desc';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'textarea';
$default_fd[$table][$field]['fd_rows'] = '3';
$default_fd[$table][$field]['fd_cols'] = '40';
$default_fd[$table][$field]['fd_help'] = 'A brief 2 sentence description of the link, used to briefly describe the link to the visitor';
$default_fd[$table][$field]['fd_mode'] = 'basic';

/* Category */
$field = 'lx_categoryid';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'dblist';
$default_fd[$table][$field]['fd_options'] = 'linkexchangecategory';
$default_fd[$table][$field]['fd_help'] = 'Category of the link, if applicable';
$default_fd[$table][$field]['fd_mode'] = 'basic';

/* Webmaster Name */
$field = 'lx_webmastername';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_name'] = 'Webmaster Name';
$default_fd[$table][$field]['fd_size'] = '30';
$default_fd[$table][$field]['fd_help'] = 'This is optional, but can be useful when you need to contact the webmaster';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* Webmaster Email */
$field = 'lx_webmasteremail';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_name'] = 'Webmaster Email';
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_size'] = '30';
$default_fd[$table][$field]['fd_help'] = 'Optional contact email for the webmaster';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* Phone */
$field = 'lx_phone';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_size'] = '30';
$default_fd[$table][$field]['fd_help'] = 'Optional field, only used for local webmasters where phone contact may be required';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* Active */
$field = 'lx_active';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'radio';
$default_fd[$table][$field]['fd_options'] =
'yes
no';
$default_fd[$table][$field]['fd_help'] = 'Inactive link exchanges will not appear on the live site. All user-submitted links are inactive by default';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* Order */
$field = 'lx_order';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'integer';
$default_fd[$table][$field]['fd_help'] = 'The order in which the link appears within it\'s category';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* priority */
$field = 'lx_priority';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_help'] = 'High priority links will appear more prominently - use when you want to give extra link benefit to a good link partner';
$default_fd[$table][$field]['fd_tabname'] = '';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* notes */
$field = 'lx_notes';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_help'] = 'Notes';
$default_fd[$table][$field]['fd_tabname'] = '';
$default_fd[$table][$field]['fd_mode'] = 'standard';
$default_fd[$table][$field]['fd_type'] = 'textarea';
$default_fd[$table][$field]['fd_rows'] = '10';
$default_fd[$table][$field]['fd_cols'] = '60';


/* STATUS TAB */
$o = 1;


/* Status */
$field = 'lx_status';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'radio';
$default_fd[$table][$field]['fd_options'] =
'ok
missing
blocked';
$default_fd[$table][$field]['fd_help'] = 'The status of your link on their page - this field is completed automatically by the Link Exchange Manager';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* Last Checked */
$field = 'lx_lastchecked';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'The date the reciprocal link was last checked';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* Links on Page */
$field = 'lx_linksonpage';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_name'] = 'External Links on Page';
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'The number of other links on the page with your link. Anything over 100 is likely to be a waste of time';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* PageRank */
$field = 'lx_pagerank';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_name'] = 'Google PageRank';
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'Google PageRank of the page where your link is hosted. PageRank is only updated every 3 months, so is not always accurate';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* Hits */
$field = 'lx_hits';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'How many hits you have referred to the other site';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* Approve Code */
$field = 'lx_approvecode';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'A code that can be used to approve the link exchange from an email';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* Delete Code */
$field = 'lx_deletecode';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'A code that can be used to delete the link exchange from an email';
$default_fd[$table][$field]['fd_tabname'] = 'Status';
$default_fd[$table][$field]['fd_mode'] = 'advanced';

/* CONTEXTUAL LINK TAB */
$o = 1;



/* BB Body */
$field = 'lx_bbbody';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'texteditor';
$default_fd[$table][$field]['fd_options'] = 'lx_body';
$default_fd[$table][$field]['fd_rows'] = '10';
$default_fd[$table][$field]['fd_cols'] = '50';
$default_fd[$table][$field]['fd_help'] = 'The body of the document.';
$default_fd[$table][$field]['fd_tabname'] = 'Presell Page';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* body */
$field = 'lx_body';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'wysiwygeditor';
$default_fd[$table][$field]['fd_help'] = '';
$default_fd[$table][$field]['fd_tabname'] = 'Presell Page';
$default_fd[$table][$field]['fd_mode'] = 'standard';

/* image */
$field = 'lx_image';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_help'] = 'An image can optionally be uploaded to make the page more visually appealing for a person';
$default_fd[$table][$field]['fd_tabname'] = 'Presell Page';
$default_fd[$table][$field]['fd_mode'] = 'standard';