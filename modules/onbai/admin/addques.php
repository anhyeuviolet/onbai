<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if ( ! defined( 'NV_IS_ONBAI_ADMIN' ) )
{
    die( 'Stop!!!' );
}

if ( defined( 'NV_EDITOR' ) )
{
    require_once ( NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php' );
}
//khoi tao gia tri
$contents = "";
$error = "";
$rowcontent['title'] =  "";
$rowcontent['quession'] =  "";
$rowcontent['anwser'] =  "";

// lay du lieu
$id = $nv_Request->get_int( 'id', 'get,post', 0 );

if ( $id == 0 )
{
    $page_title = $lang_module['addques'];
}
else
{
    $page_title = $lang_module['editques'];
	$sql = "SELECT * FROM `" . NV_PREFIXLANG . "_" . $module_data . "_quessions` WHERE `id` = ".$id."";
	$resuilt = $db->sql_query( $sql );
	$row = $db->sql_fetchrow( $resuilt );
	$rowcontent['title'] = $row['title'];
	$rowcontent['quession'] = $row['quession'];
	$rowcontent['anwser'] = $row['anwser'];

}

//sua cau hoi
if ( $nv_Request->get_int( 'edit', 'post', 0 ) == 1 )
{
	$rowcontent['title'] = filter_text_input( 'title', 'post', '' );
	$rowcontent['quession'] = $nv_Request->get_string( 'ques', 'post', '' );
	$rowcontent['anwser'] = $nv_Request->get_string( 'anwser', 'post', '' );
	foreach ( $rowcontent as $key => $data  )
	{	
		$query = mysql_query("UPDATE `" . NV_PREFIXLANG . "_" . $module_data . "_quessions` SET `".$key."` = " . $db->dbescape( $data ) . " WHERE `id` =" . $id . "");
	}
	if ( $query ) 
	{
		Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name); die();
	}
	else
	{
		$error = $lang_module['error_save'];
	}
}

// them cau hoi
if ( $nv_Request->get_int( 'add', 'post', 0 ) == 1 )
{	
	
	// lay theo post
	$rowcontent['title'] = filter_text_input( 'title', 'post', '' );
	$rowcontent['quession'] = $nv_Request->get_string( 'ques', 'post', '' );
	$rowcontent['anwser'] = $nv_Request->get_string( 'anwser', 'post', '' );
	if ( $rowcontent['title'] == '' )
	{
		$error = $lang_module['error_full_title'];
	} 
	elseif ( $rowcontent['quession'] == '' )
	{
		$error = $lang_module['error_full_ques'];
	}
	elseif ( $rowcontent['anwser'] == '' )
	{
		$error = $lang_module['error_full_anwser'];
	}
	else
	{
		$query = "INSERT INTO `" . NV_PREFIXLANG . "_" . $module_data . "_quessions` 
		(
			`id`, `title`, `quession`, `anwser`
		) 
		VALUES 
		( 
			NULL, 
			" . $db->dbescape( $rowcontent['title'] ) . ", 
			" . $db->dbescape( $rowcontent['quession'] ) . ", 
			" . $db->dbescape( $rowcontent['anwser'] ) . " 
		)
		"; 
		if ( $db->sql_query_insert_id( $query ) ) 
		{ 
			$db->sql_freeresult();
			Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name); die();
		} 
		else 
		{ 
			$error = $lang_module['error_save']; 
		} 

	}

}
if($error)
{
	$contents .= "<div class=\"quote\" style=\"width: 780px;\">\n
					<blockquote class=\"error\">
						<span>".$error."</span>
					</blockquote>
				</div>\n
				<div class=\"clear\">
				</div>";
}

$contents .="
<form method=\"post\" name=\"add_pic\">
	<table class=\"tab1\">
		<thead>
			<tr>
				<td colspan=\"2\">
					".$lang_module['ques']."
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style=\"width: 150px; background: #eee;\">
					".$lang_module['quession_title']."
				</td>
				<td style=\"background: #eee;\">
					<input name=\"title\" style=\"width: 470px;\" value=\"".$rowcontent['title']."\" type=\"text\">
				</td>
			</tr>
			<tr>
				<td colspan=\"2\"><strong>".$lang_module['ques_body']."</strong></td>
			</tr>
			<tr>
				<td colspan=\"2\">";
				if ( defined( 'NV_EDITOR' ) and function_exists( 'nv_aleditor' ) )
				{
					$contents .= nv_aleditor( 'ques', '810px', '300px', $rowcontent['quession'] );
				}
				else
				{
					$contents .= "<textarea style=\"width: 810px\" value=\"".$rowcontent['quession']."\" name=\"ques\" id=\"ques\" cols=\"20\" rows=\"15\"></textarea>\n";
				}
				$contents .="
				</td>
			</tr>
			<tr>
				<td colspan=\"2\"><strong>".$lang_module['anwser']."</strong></td>
			</tr>
			<tr>
				<td colspan=\"2\">";
				if ( defined( 'NV_EDITOR' ) and function_exists( 'nv_aleditor' ) )
				{
					$contents .= nv_aleditor( 'anwser', '810px', '300px', $rowcontent['anwser'] );
				}
				else
				{
					$contents .= "<textarea style=\"width: 810px\" value=\"".$rowcontent['anwser']."\" name=\"anwser\" id=\"anwser\" cols=\"20\" rows=\"15\"></textarea>\n";
				}
				$contents .="
				</td>
			</tr>
			<tr>
				<td colspan=\"2\" align=\"center\" style=\"background: #eee;\">\n
					<input name=\"confirm\" value=\"".$lang_module['save']."\" type=\"submit\">\n";
					if ( $id == 0 ) 
						$contents .="<input type=\"hidden\" name=\"add\" id=\"add\" value=\"1\">\n";
					else
						$contents .="<input type=\"hidden\" name=\"edit\" id=\"edit\" value=\"1\">\n";
                    $contents .="<span name=\"notice\" style=\"float: right; padding-right: 50px; color: red; font-weight: bold;\"></span>\n
				</td>\n
			</tr>\n
		</tbody>\n
	</table>\n
</form>\n";

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
?>