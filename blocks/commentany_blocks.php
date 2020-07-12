<?php
/**
@brief 
@version $Id$
*/

/**
@brief $xoopsTpl のコンパイルロジックを交換し、コンテンツの下にコメントフォームを表示できるようにする
*/
function b_commentany_hook_execute($options)
{
	global $xoopsUser;
	global $xoopsTpl;
	global $xoopsModule, $xoopsModuleConfig;
	global $xoopsConfig;
	
	include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
	include_once XOOPS_ROOT_PATH.'/include/comment_constants.php';

	if(!is_object($xoopsModule))
		return null;

	$config=$xoopsModule->getInfo('comments');
	if(!count($config))
		return null;

	// このまま進んではいけないケースの判断
	if( empty( $xoopsModuleConfig['com_rule'] ) ) return null ;
	switch($xoopsModuleConfig['com_rule']) {
		case XOOPS_COMMENT_APPROVENONE:
			return null;

/*		case XOOPS_COMMENT_APPROVEUSER:
		case XOOPS_COMMENT_APPROVEADMIN:	// FIXME: ホント??
			if(!is_object($xoopsUser))
				return null; */
	}

	// パスを取り出す
	$xoops_root_path = strtr(XOOPS_ROOT_PATH,"\\","/");
	$path= $_SERVER['SCRIPT_FILENAME'];
	if($pos=strrpos($path,"/"))
		$path=substr($path,$pos+1);

	if($path==$config['pageName']) {
		// 言語ファイルの読み込み
		require_once XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/comment.php';

		$arr=array();

		require_once dirname(__FILE__)."/../include/Smarty_CustomCompiler.php";
		$xoopsTpl->compiler_class="CommentAnyTplHookCompiler";
		$arr['com_itemid']=intval($_REQUEST[$config['itemName']]);

		// 権限を見よう
		switch ($xoopsModuleConfig['com_rule']) {
			case XOOPS_COMMENT_APPROVEALL:
				$arr['rule_text'] = _CM_COMAPPROVEALL;
				break;

			case XOOPS_COMMENT_APPROVEUSER:
				$arr['rule_text'] = _CM_COMAPPROVEUSER;
				break;

			case XOOPS_COMMENT_APPROVEADMIN:
				default:
				$arr['rule_text'] = _CM_COMAPPROVEADMIN;
				break;
		}

		// check com_itemid
		if( ! is_object( $xoopsUser ) && empty( $xoopsModuleConfig['com_anonpost'] ) ) $arr['com_itemid'] = 0 ;

		$icons=XoopsLists::getSubjectsList();
		foreach($icons as $k=>$v) {
			$arr['com_icon'][] = $v;
		}

		// for XOOPS >= 2.0.10
		if( is_object( @$GLOBALS['xoopsSecurity'] ) ) {
			$arr['xoops_token_request'] = $GLOBALS['xoopsSecurity']->createToken() ;
		} else {
			$arr['xoops_token_request'] = '' ;
		}

		$xoopsTpl->assign("commentany",$arr);
	}
	return null;
}

?>