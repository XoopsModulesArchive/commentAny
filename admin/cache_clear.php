<?php
/**
@brief templates_c の中をすべて空にします
@author minahito
@version $Id$
*/

$xoopsOption['nocommon']=true;
include_once "../../../mainfile.php";
require_once XOOPS_ROOT_PATH."/modules/exFrame/frameloader.php";

require_once "exComponent/confirm/TypicalConfirm.php";

require_once "include/OnetimeTicket.php";

require_once "./include/confirm.php";

// Session 開始
require_once XOOPS_ROOT_PATH."/include/common.php";
require_once XOOPS_ROOT_PATH."/include/cp_header.php";

// 画面遷移設定
$forwards=array(new exSuccessForwardConfig(EXFORWARD_REDIRECT,"index.php","Clear Success"),
		new exFailForwardConfig(EXFORWARD_REDIRECT,"index.php","Clear Fail"));

$compo = new exTypicalConfirmComponent(new TemplateCDeleteProcessor(),
				new exConfirmComponentModelRender(),
				'template_c_clear',new exConfirmTicketForm(),$forwards);
$dmy=null;
switch($compo->init($dmy)) {
	case COMPONENT_INIT_FAIL:
		die;

	case COMPONENT_INIT_SUCCESS:
		xoops_cp_header();
		require_once "./head.php";

		print "<p>"._MD_A_COMMENTANY_LANG_MESSAGE_CACHECLEAR_CONFIRM."</p>";

		$compo->display();
		xoops_cp_footer();
		break;
}

?>
