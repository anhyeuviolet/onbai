<?php

/**
 * @Project ONBAI 4.x
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1/21/2017, 10:56:09 PM
 */

if (!defined('NV_ADMIN'))
    die('Stop!!!');

$submenu['addques'] = $lang_module['addques'];
$submenu['test'] = $lang_module['test'];
$submenu['addtest'] = $lang_module['addtest'];
$submenu['compulsory'] = $lang_module['compulsory'];
$submenu['addcompulsory'] = $lang_module['addcompulsory'];

$allow_func = array(
    'main',
    'addques',
    'test',
    'addtest',
    'compulsory',
    'addcompulsory',
    'delques',
    'delallques',
    'delalltest',
    'delallcompulsory',
    'deltest',
    'delcompulsory'
);
