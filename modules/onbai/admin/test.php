<?php

/**
 * @Project ONBAI 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1/21/2017, 10:56:09 PM
 */

if (!defined('NV_IS_ONBAI_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['test'];

$xtpl = new XTemplate("test.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_name);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('LINK_ADD', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=addtest");
$xtpl->assign('URL_DEL_BACK', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
$xtpl->assign('URL_DEL', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=delalltest");

//lay du lieu
$result = $db->query("SELECT * FROM  " . NV_PREFIXLANG . "_" . $module_data . "_test");
$num = $result->rowCount();

$link_del = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=deltest";
$link_edit = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=addtest";

while ($rs = $result->fetch()) {
    $xtpl->assign('id', $rs['id']);
    $xtpl->assign('title', $rs['title']);

    $class = ($i % 2) ? " class=\"second\"" : "";
    $xtpl->assign('class', $class);
    $xtpl->assign('URL_DEL_ONE', $link_del . "&id=" . $rs['id']);
    $xtpl->assign('URL_EDIT', $link_edit . "&id=" . $rs['id']);
    $xtpl->parse('main.row');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");
