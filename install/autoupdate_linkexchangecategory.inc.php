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

$table = 'linkcategory';
$o = 1;

$default_td['linkexchangecategory']['td_displayname'] = 'Link Exchange Category';
$default_td['linkexchangecategory']['td_displayfield'] = 'lc_name';
$default_td['linkexchangecategory']['td_parentfield'] = 'lc_parent';
$default_td['linkexchangecategory']['td_rolloverfield'] = 'lc_desc';
$default_td['linkexchangecategory']['td_orderbyfields'] = 'lc_order,lc_name';
$default_td['linkexchangecategory']['td_topsubmit'] = 'yes';
$default_td['linkexchangecategory']['td_deleteoption'] = 'yes';
$default_td['linkexchangecategory']['td_menutype'] = 'dtree';
$default_td['linkexchangecategory']['td_help'] = '';

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

//Description
$default_fd[$table]['lc_desc']['fd_order'] = $o++;
$default_fd[$table]['lc_desc']['fd_type'] = 'textarea';
$default_fd[$table]['lc_desc']['fd_rows'] = '3';
$default_fd[$table]['lc_desc']['fd_cols'] = '40';
$default_fd[$table]['lc_desc']['fd_help'] = '';

//Order
$default_fd[$table]['lc_order']['fd_order'] = $o++;
$default_fd[$table]['lc_order']['fd_type'] = 'integer';
$default_fd[$table]['lc_order']['fd_help'] = '';

//Image
$default_fd[$table]['lk_image']['fd_order'] = $o++;
$default_fd[$table]['lk_image']['fd_type'] = 'fileupload';
$default_fd[$table]['lk_image']['fd_help'] = 'Optional image to represent the category';


?>