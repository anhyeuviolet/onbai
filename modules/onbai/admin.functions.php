<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES ., JSC. All rights reserved
 * @Createdate Dec 3, 2010  11:11:28 AM 
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu['addques'] = $lang_module['addques'];
$submenu['test'] = $lang_module['test'];
$submenu['addtest'] = $lang_module['addtest'];
$submenu['compulsory'] = $lang_module['compulsory'];
$submenu['addcompulsory'] = $lang_module['addcompulsory'];

$allow_func = array( 
    'main', 'addques', 'test', 'addtest', 'compulsory', 'addcompulsory', 'delques', 'delallques', 'delalltest', 'delallcompulsory', 'deltest', 'delcompulsory' 
);

define( 'NV_IS_ONBAI_ADMIN', true );

?>