<?php

/**
 * @Project ONBAI 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1/21/2017, 10:56:09 PM
 */

if (!defined('NV_IS_MOD_ONBAI'))
    die('Stop!!!');

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

//khoi tao
$array_data = "";

// lay thong tin
$id = $nv_Request->get_int('page', 'get', 0);

$num_page = "select * from " . NV_PREFIXLANG . "_" . $module_data . "_compulsory";
$num = $db->query($num_page);
$output = $num->rowCount();
if ($output == $id)
    $end = 1;
else
    $end = 0;


$sql_data = "select * from " . NV_PREFIXLANG . "_" . $module_data . "_compulsory ORDER BY ID DESC LIMIT " . $id . ",1";

$contents = nv_theme_onbai_compulsory($sql_data, $id, $end);

include (NV_ROOTDIR . "/includes/header.php");
echo nv_site_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");
