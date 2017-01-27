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
// tao gia tri
$result = false;
$id = $nv_Request->get_int('id', 'post,get');

// xoa cau hoi
if ($id > 0) {
    $sql = "DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_compulsory WHERE id=" . $id;
    $result = $db->query($sql);
}

// tra ve gia tri
if ($result) {
    echo $lang_module['delalbum_success'];
} else {
    echo $lang_module['delalbum_error'];
}
