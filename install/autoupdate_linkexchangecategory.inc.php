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

$table = 'linkexchangecategory';
$o = 1;

$default_td[$table]['td_displayname'] = 'Link Exchange Category';
$default_td[$table]['td_displayfield'] = 'lc_name';
$default_td[$table]['td_parentfield'] = 'lc_parent';
$default_td[$table]['td_rolloverfield'] = 'lc_desc';
$default_td[$table]['td_orderbyfields'] = 'lc_order,lc_name';
$default_td[$table]['td_topsubmit'] = 'yes';
$default_td[$table]['td_deleteoption'] = 'yes';
$default_td[$table]['td_menutype'] = 'list';
$default_td[$table]['td_help'] = '';

//Link Category ID
$default_fd[$table]['linkcategoryid']['fd_order'] = $o++;
$default_fd[$table]['linkcategoryid']['fd_type'] = 'readonly';
$default_fd[$table]['linkcategoryid']['fd_help'] = 'A unique ID, automatically assigned by the system';

//Name
$default_fd[$table]['lc_name']['fd_order'] = $o++;
$default_fd[$table]['lc_name']['fd_type'] = 'text';
$default_fd[$table]['lc_name']['fd_required'] = 'yes';
$default_fd[$table]['lc_name']['fd_size'] = '40';
$default_fd[$table]['lc_name']['fd_help'] = '';

//SEO Title
$default_fd[$table]['lc_seotitle']['fd_order'] = $o++;
$default_fd[$table]['lc_seotitle']['fd_type'] = 'text';
$default_fd[$table]['lc_seotitle']['fd_size'] = '40';
$default_fd[$table]['lc_seotitle']['fd_help'] = '';
$default_fd[$table]['lc_seotitle']['fd_options'] = 'seotitle';

//Description
$default_fd[$table]['lc_desc']['fd_order'] = $o++;
$default_fd[$table]['lc_desc']['fd_type'] = 'textarea';
$default_fd[$table]['lc_desc']['fd_options'] = 'metadescription';
$default_fd[$table]['lc_desc']['fd_rows'] = '3';
$default_fd[$table]['lc_desc']['fd_cols'] = '40';
$default_fd[$table]['lc_desc']['fd_help'] = '';

//bbbody
$default_fd[$table]['lc_bbody']['fd_order'] = $o++;
$default_fd[$table]['lc_bbody']['fd_type'] = 'texteditor';
$default_fd[$table]['lc_bbody']['fd_options'] = 'lc_body';
$default_fd[$table]['lc_bbody']['fd_rows'] = '10';
$default_fd[$table]['lc_bbody']['fd_cols'] = '50';
$default_fd[$table]['lc_bbody']['fd_help'] = '';

//Body
$default_fd[$table]['lc_body']['fd_order'] = $o++;
$default_fd[$table]['lc_body']['fd_type'] = 'fckeditor';
$default_fd[$table]['lc_body']['fd_options'] = 'metadescription';
$default_fd[$table]['lc_body']['fd_rows'] = '10';
$default_fd[$table]['lc_body']['fd_cols'] = '50';
$default_fd[$table]['lc_body']['fd_help'] = '';


//Order
$default_fd[$table]['lc_order']['fd_order'] = $o++;
$default_fd[$table]['lc_order']['fd_type'] = 'integer';
$default_fd[$table]['lc_order']['fd_help'] = '';

//Image
$default_fd[$table]['lc_image']['fd_order'] = $o++;
$default_fd[$table]['lc_image']['fd_type'] = 'fileupload';
$default_fd[$table]['lc_image']['fd_help'] = 'Optional image to represent the category';

//Parent
$default_fd[$table]['lc_parent']['fd_order'] = $o++;
$default_fd[$table]['lc_parent']['fd_type'] = 'integer';
$default_fd[$table]['lc_parent']['fd_help'] = '';

?>