<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 2-9-2010 14:43
 */
if(!defined('NV_IS_MOD_ONBAI'))
{
	die('Stop!!!');
}

// lay du lieu
$ok = false;
$id = $nv_Request->get_int('id', 'get,post', 0 );
$anwser = $nv_Request->get_int('anwser', 'get,post', 0 );
$what_select = $nv_Request->get_int('what_select', 'get,post', 0 );

if ($what_select == 2)
{
	$what_select = "compulsory";
}
else $what_select = "test";

// xoa cau hoi
if($id > 0)
{
	$sql = "SELECT * FROM `" . NV_PREFIXLANG . "_" . $module_data . "_".$what_select."` WHERE `id`=" . $id;
    $result = $db->sql_query( $sql );
	while ( $row = mysql_fetch_array($result) )
		if ( $row['trueanwser'] == $anwser ) $ok = 1 ;
}

// tra ve gia tri
if($ok)
{
	echo 1;
}
else
{
	echo 2;
}
?>