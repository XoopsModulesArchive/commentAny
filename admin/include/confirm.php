<?php
/**
@version $Id$
*/

require_once "exComponent/render/ConfirmModelRender.php";
require_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

/**
@brief XOOPS_COMPILE_PATH 内のファイルを全て削除するためのロジック
*/
class TemplateCDeleteProcessor extends exTypicalConfirmComponentProcessor
{
	function _processPost($component) {
		if($handler=opendir(XOOPS_COMPILE_PATH."/")) {
			while(($file=readdir($handler)) !== false) {
				@unlink (XOOPS_COMPILE_PATH."/".$file);
			}
			return true;
		}
		else {
			return false;
		}
	}
}

?>
