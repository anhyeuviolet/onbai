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

if (defined('NV_EDITOR')) {
    require_once (NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php');
}
//khoi tao gia tri
$contents = "";
$error = "";
$rowcontent['title'] = "";
$rowcontent['quession'] = "";
$rowcontent['anwser'] = "";

// lay du lieu
$id = $nv_Request->get_int('id', 'get,post', 0);

if ($id == 0) {
    $page_title = $lang_module['addques'];
} else {
    $page_title = $lang_module['editques'];
    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_quessions WHERE id = " . $id;
    $resuilt = $db->query($sql);
    $row = $resuilt->fetch();
    $rowcontent['title'] = $row['title'];
    $rowcontent['quession'] = $row['quession'];
    $rowcontent['anwser'] = $row['anwser'];
}

//sua cau hoi
if ($nv_Request->get_int('edit', 'post', 0) == 1) {
    $rowcontent['title'] = $nv_Request->get_title('title', 'post', '');
    $rowcontent['quession'] = $nv_Request->get_string('ques', 'post', '');
    $rowcontent['anwser'] = $nv_Request->get_string('anwser', 'post', '');
    foreach ($rowcontent as $key => $data) {
        $query = $db->query("UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_quessions SET " . $key . " = " . $db->quote($data) . " WHERE id =" . $id);
    }
    if ($query) {
        Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
        die();
    } else {
        $error = $lang_module['error_save'];
    }
}

// them cau hoi
if ($nv_Request->get_int('add', 'post', 0) == 1) {

    // lay theo post
    $rowcontent['title'] = $nv_Request->get_title('title', 'post', '');
    $rowcontent['quession'] = $nv_Request->get_string('ques', 'post', '');
    $rowcontent['anwser'] = $nv_Request->get_string('anwser', 'post', '');
    if ($rowcontent['title'] == '') {
        $error = $lang_module['error_full_title'];
    } elseif ($rowcontent['quession'] == '') {
        $error = $lang_module['error_full_ques'];
    } elseif ($rowcontent['anwser'] == '') {
        $error = $lang_module['error_full_anwser'];
    } else {
        $query = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_quessions 
        (
            id, title, quession, anwser
        ) 
        VALUES 
        ( 
            NULL, 
            " . $db->quote($rowcontent['title']) . ", 
            " . $db->quote($rowcontent['quession']) . ", 
            " . $db->quote($rowcontent['anwser']) . " 
        )
        ";
        if ($db->insert_id($query, 'id')) {
            Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
            die();
        } else {
            $error = $lang_module['error_save'];
        }

    }

}
if ($error) {
    $contents .= "<div class=\"quote\" style=\"width: 780px;\">\n
                    <blockquote class=\"error\">
                        <span>" . $error . "</span>
                    </blockquote>
                </div>\n
                <div class=\"clear\">
                </div>";
}

$contents .= "
<form method=\"post\" name=\"add_pic\">
    <div class=\"table-responsive\">
    <table class=\"table table-striped table-bordered table-hover\">
        <thead>
            <tr>
                <td colspan=\"2\">
                    " . $lang_module['ques'] . "
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=\"width: 150px;\">
                    " . $lang_module['quession_title'] . "
                </td>
                <td>
                    <input name=\"title\" style=\"width: 470px;\" value=\"" . $rowcontent['title'] . "\" type=\"text\" class=\"form-control\">
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['ques_body'] . "</strong></td>
            </tr>
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('ques', '100%', '300px', $rowcontent['quession']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['quession'] . "\" name=\"ques\" id=\"ques\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\"><strong>" . $lang_module['anwser'] . "</strong></td>
            </tr>
            <tr>
                <td colspan=\"2\">";
if (defined('NV_EDITOR') and function_exists('nv_aleditor')) {
    $contents .= nv_aleditor('anwser', '100%', '300px', $rowcontent['anwser']);
} else {
    $contents .= "<textarea style=\"width: 100%\" value=\"" . $rowcontent['anwser'] . "\" name=\"anwser\" id=\"anwser\" cols=\"20\" rows=\"15\"></textarea>\n";
}
$contents .= "
                </td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"center\">\n
                    <input name=\"confirm\" value=\"" . $lang_module['save'] . "\" type=\"submit\" class=\"btn btn-primary\">\n";
if ($id == 0)
    $contents .= "<input type=\"hidden\" name=\"add\" id=\"add\" value=\"1\">\n";
else
    $contents .= "<input type=\"hidden\" name=\"edit\" id=\"edit\" value=\"1\">\n";
$contents .= "<span name=\"notice\" style=\"float: right; padding-right: 50px; color: red; font-weight: bold;\"></span>\n
                </td>\n
            </tr>\n
        </tbody>\n
    </table>\n
    </div>\n
</form>\n";

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");
