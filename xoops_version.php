<?php
/**
@file
@brief xoops 用 module 設定ファイル
@author minahito
*/

$modversion['name'] = _MI_COMMENTANY_NAME;
$modversion['version'] = 0.14;
$modversion['description'] = _MI_COMMENTANY_DESC;

$modversion['credits'] = "minahito";
$modversion['author'] = "minahito" ;
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/commentAny.png";
$modversion['dirname'] = "commentAny";

// Template
$modversion['use_smarty'] = 0;

// Block
$modversion['blocks'][1]['file'] = "commentany_blocks.php";
$modversion['blocks'][1]['name'] = _MI_COMMENTANY_BNAME1;
$modversion['blocks'][1]['show_func'] = "b_commentany_hook_execute";
$modversion['blocks'][1]['template'] = '';

// Sql
// $modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Template
$modversion['use_smarty'] = 1;
$modversion['templates'][0]['file'] = 'commentany_center.html';
$modversion['templates'][0]['description'] = '';


// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/howto.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 0;

?>