<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

require_once SMARTY_DIR."Smarty_Compiler.class.php";

eval( '

class CommentAnyTplHookCompiler extends '.$xoopsTpl->compiler_class.'
{
	function _compile_file($tpl_file,$template_source,&$template_compiled)
	{
		static $flag=null;
		global $xoopsOption;

		$tmp_tpl_file=$tpl_file;
		$template_main= isset($xoopsOption["template_main"]) ? $xoopsOption["template_main"] : "";
		
		if($pos=strpos($tmp_tpl_file,":"))
			$tmp_tpl_file=substr($tmp_tpl_file,$pos+1);
		if($pos=strpos($template_main,":"))
			$template_main=substr($template_main,$pos+1);

		if ($tmp_tpl_file==$template_main) {
			if(!$flag) {
				list( $pre , $post ) = explode( \'<{$commentsnav}>\' , $template_source ) ;
				if( empty( $post ) ) {
					$template_source.=\'<{include file="db:commentany_center.html"}>\';
				} else {
					$template_source = $pre . \'<{include file="db:commentany_center.html"}>\' . $post ;
				}
			}
		}

		return parent::_compile_file($tpl_file,$template_source,&$template_compiled);
	}

}

' ) ;

?>