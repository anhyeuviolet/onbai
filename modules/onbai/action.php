<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES ., JSC. All rights reserved
 * @Createdate Dec 3, 2010  11:10:39 AM 
 */
if(!defined('NV_IS_FILE_MODULES'))
	die('Stop!!!');


$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_quessions`";
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_test`";
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_compulsory`";

//cau hoi
$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_quessions` (
`id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`quession` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwser` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8";


//trac nghiem
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_test` (
`id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`quession` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwsera` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwserb` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwserc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwserd` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`explain_true` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`explain_false` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`trueanwser` INT( 5 ) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8";

//trac nghiem bat buoc
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_compulsory` (
`id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`quession` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwsera` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwserb` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwserc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`anwserd` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`trueanwser` INT( 5 ) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8";

?>