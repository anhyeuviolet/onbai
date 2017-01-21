<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES ., JSC. All rights reserved
 * @Createdate Dec 3, 2010  11:32:04 AM 
 */

if ( ! defined( 'NV_IS_MOD_ONBAI' ) ) die( 'Stop!!!' );

function nv_theme_samples_main ( $sql_data, $now_page )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $module_data;
    $xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'URL_QUES', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name."" );
    $xtpl->assign( 'URL_TEST', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=test" );
    $xtpl->assign( 'URL_COMPULSORY', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=compulsory" );
    
	//
	$data = mysql_query($sql_data);
	$i = 1 ;
	while ( $row = mysql_fetch_array($data) )
	{
		$xtpl->assign( 'title', $row['title'] );
		$xtpl->assign( 'ques', $row['quession'] );
		$xtpl->assign( 'anwser', $row['anwser'] );
		$xtpl->assign( 'DIV', $i );
		
		$xtpl->parse( 'main.loop' );
		$i ++ ;
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function nv_theme_onbai_test( $sql_data, $now_page )
	{
		global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $module_data;
		$xtpl = new XTemplate( "test.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
		$xtpl->assign( 'LANG', $lang_module );
		$xtpl->assign( 'URL_QUES', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name."" );
		$xtpl->assign( 'URL_TEST', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=test" );
		$xtpl->assign( 'URL_COMPULSORY', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=compulsory" );

		$data = mysql_query($sql_data);
		$i = 1 ;
		while ( $row = mysql_fetch_array($data) )
		{
			$xtpl->assign( 'title', $row['title'] );
			$xtpl->assign( 'ques', $row['quession'] );
			$xtpl->assign( 'anwsera', $row['anwsera'] );
			$xtpl->assign( 'anwserb', $row['anwserb'] );
			$xtpl->assign( 'anwserc', $row['anwserc'] );
			$xtpl->assign( 'anwserd', $row['anwserd'] );
			$xtpl->assign( 'explain_true', $row['explain_true'] );
			$xtpl->assign( 'explain_false', $row['explain_false'] );
			$xtpl->assign( 'DIV', $i );
			$xtpl->assign( 'URL', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=testanwser&what_select=1&id=".$row['id']."" );
			
			$xtpl->parse( 'main.loop' );
			$i ++ ;
		}
		

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );

	}
// bat buoc
function nv_theme_onbai_compulsory( $sql_data, $id, $end )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $module_data;
    $xtpl = new XTemplate( "compulsory.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'URL_QUES', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name."" );
    $xtpl->assign( 'URL_TEST', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=test" );
    $xtpl->assign( 'URL_COMPULSORY', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=compulsory" );

	if( $end )
	{
		$xtpl->parse( 'end' );
		return $xtpl->text( 'end' );
	}
	else
	{	
		$id = $id + 1;
		$xtpl->assign( 'NEXTURL', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=compulsory&page=" . $id . "" );
		
		// viet ra cau hoi
		$data = mysql_query($sql_data);
		while ( $row = mysql_fetch_array($data) )
		{
			$xtpl->assign( 'URL', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=testanwser&what_select=2&id=".$row['id']."" );
			$xtpl->assign( 'title', $row['title'] );
			$xtpl->assign( 'ques', $row['quession'] );
			$xtpl->assign( 'anwsera', $row['anwsera'] );
			$xtpl->assign( 'anwserb', $row['anwserb'] );
			$xtpl->assign( 'anwserc', $row['anwserc'] );
			$xtpl->assign( 'anwserd', $row['anwserd'] );
			
		}
		
		// xuat
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}
?>