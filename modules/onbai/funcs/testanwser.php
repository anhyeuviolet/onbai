<?php

/**
 * @Project ONBAI 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1/21/2017, 10:56:09 PM
 */

if (!defined('NV_IS_MOD_ONBAI')) {
    die('Stop!!!');
}

// lay du lieu
$ok = false;
$id = $nv_Request->get_int('id', 'get,post', 0);
$anwser = $nv_Request->get_int('anwser', 'get,post', 0);
$what_select = $nv_Request->get_int('what_select', 'get,post', 0);

if ($what_select == 2) {
    $what_select = "compulsory";
} else
    $what_select = "test";

// xoa cau hoi
if ($id > 0) {
    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_" . $what_select . " WHERE id=" . $id;
    $result = $db->query($sql);
    while ($row = $result->fetch())
        if ($row['trueanwser'] == $anwser)
            $ok = 1;
}

// tra ve gia tri
if ($ok) {
    echo 1;
} else {
    echo 2;
}
