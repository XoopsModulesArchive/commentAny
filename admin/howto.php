<?php
/**
@brief 簡易説明書(実験)
@version $Id$
*/
include_once "../../../mainfile.php";
include_once XOOPS_ROOT_PATH."/include/cp_header.php";
require_once XOOPS_ROOT_PATH."/modules/exFrame/frameloader.php";

xoops_cp_header();

include_once "head.php";

if(isset($xoopsConfig['language'])) {
	$file = XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language']."/howto.txt";
	if(file_exists($file)) {
		$ts=&MyTextSanitizer::getInstance();
		$text = exFrame::file_get_contents($file);
		print $ts->displayTarea($text);
	}
	else
		print "Sorry, manual not exist.";
}
else {
	print "Sorry, manual not exist.";
}

xoops_cp_footer();

?>
