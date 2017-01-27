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

// lay thong tin
$now_page = $nv_Request->get_int('now_page', 'get', 0);

// xu li
$num_page = "select * from " . NV_PREFIXLANG . "_" . $module_data . "_test";
$num = $db->query($num_page);
$output = $num->rowCount();
$ts = 1;
while ($ts * 5 < $output) {
    $ts++;
}
if (!$now_page) {
    $now_page = 1;
    $first_page = 0;
} else {
    $first_page = ($now_page - 1) * 5;
}
$sql_data = "select * from " . NV_PREFIXLANG . "_" . $module_data . "_test ORDER BY ID DESC LIMIT " . $first_page . ",5";

$contents = nv_theme_onbai_test($sql_data, $now_page);
#############################--------------HIEN THI CAC TRANG----------###############################
if ($ts > 1) {
    $contents .= "<div id=\"numpage\"><p>";
    if ($ts > 5 and $now_page > 3) {
        $contents .= "<a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
        $contents .= "&amp;now_page=1\" class=\"next\">&lt;&lt;</a> ... ";
    }
    if ($now_page > 1) {
        $now_page_min = $now_page - 1;
        $contents .= "<a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
        $contents .= "&now_page=" . $now_page_min . "\" class=\"next\">&lt;</a> ";
    }
    if ($ts <= 5) {
        $i = 1;
        while ($i <= $ts) {
            if ($i == $now_page) {
                $contents .= "<b> " . $i . " </b>";
            } else {
                $contents .= "<a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
                $contents .= "&now_page=" . $i . "\">" . $i . "</a> ";
            }
            $i++;
        }
    } else
        if ($now_page <= 2) {
            $i = 1;
            while ($i <= 5) {
                if ($now_page == $i) {
                    $contents .= "<b> " . $i . " </b>";
                } else {
                    $contents .= "<a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
                    $contents .= "&now_page=" . $i . "\">" . $i . "</a> ";
                }
                $i++;
            }
        } else
            if ($now_page < ($ts - 2)) {
                $i = 1;
                $j = $now_page - 2;
                while ($i <= 5) {
                    if ($now_page == $j) {
                        $contents .= "<b> " . $j . " </b>";
                    } else {
                        $contents .= "<a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
                        $contents .= "&now_page=" . $j . "\">" . $j . "</a> ";
                    }
                    $i++;
                    $j++;
                }
            } else {
                $i = 1;
                $j = $ts - 4;
                while ($i <= 5) {
                    if ($now_page == $j) {
                        $contents .= "<b> " . $j . " </b>";
                    } else {
                        $contents .= "<a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
                        $contents .= "&now_page=" . $j . "\">" . $j . "</a> ";
                    }
                    $i++;
                    $j++;
                }
            }
            if ($now_page < $ts) {
                $now_page_max = $now_page + 1;
                $contents .= " <a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
                $contents .= "&now_page=" . $now_page_max . "\" class=\"next\">&gt;</a>";
            }
    if (($ts > 5) and ($now_page < ($ts - 2))) {
        $contents .= " ... <a href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=test";
        $contents .= "&now_page=" . $ts . "\" class=\"next\">&gt;&gt;</a>";
    }
    $contents .= "</p></div>";
}

include (NV_ROOTDIR . "/includes/header.php");
echo nv_site_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");
