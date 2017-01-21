<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES ., JSC. All rights reserved
 * @Createdate Dec 3, 2010  11:32:04 AM 
 */

if ( ! defined( 'NV_IS_MOD_ONBAI' ) ) die( 'Stop!!!' );
$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
//khoi tao 
$array_data = "" ;

// lay thong tin
$id = $nv_Request->get_int( 'page', 'get', 0 );

$num_page = "select * from " . NV_PREFIXLANG . "_" . $module_data . "_compulsory";
$num = mysql_query($num_page);
$output = mysql_num_rows($num);
if ( $output == $id ) $end = 1 ; else $end = 0 ;


$sql_data = "select * from " . NV_PREFIXLANG . "_" . $module_data . "_compulsory ORDER BY ID DESC LIMIT ".$id.",1";

$contents = nv_theme_onbai_compulsory( $sql_data, $id, $end );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>