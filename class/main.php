<?php

	// 객체지향 개념이 아닌, 클래스간의 협업 개념으로 작성

	$MENU   = new CMENU();
	$SCREEN = new CSCREEN();
	
	if( $SETUP["USING_DB"] )
		$DB 	= new CDB();
	
	if( $SETUP["USING_BBS"] ) {
		BBS_MODE( $SETUP["BBS_MODE"] );
		include $BBS_INCLUDE;

		$BBS 	= new CBBS();
	}

	$SCREEN->ADD_CSS 	 ( $SETUP["CSS"] );
	$SCREEN->ADD_JSCRIPT ( $SETUP["JSCRIPT"] );

	if( $SETUP["AUTO_</HTML>"] ) {
		register_shutdown_function("HTMLCLOSE");
	}

	if( $SETUP["DEFAULT_MENU_FILE"] ) {
		include $SETUP["DEFAULT_MENU_FILE"];
	}

	// --------------------------------
	function BBS_MODE( $MODE="" )
	{
		global $BBS_INCLUDE;

		switch( $MODE ) {
		default:
		case BBS_MODE_LIST:
			$BBS_INCLUDE = "bbs.list.php";
			break;
		case BBS_MODE_PRINT:
		case BBS_MODE_VIEW:
			$BBS_INCLUDE = "bbs.view.php";
			break;
		case BBS_MODE_WRITE:
		case BBS_MODE_REPLY:
		case BBS_MODE_EDIT:
			$BBS_INCLUDE = "bbs.write.php";
			break;
		case BBS_MODE_DELETE: 
			$BBS_INCLUDE = "bbs.delete.php";
			break;
		case BBS_MODE_WORK_SAVE:
			$BBS_INCLUDE = "bbs.worksave.php";
			break;
		case BBS_MODE_WORK_DEL: 
			$BBS_INCLUDE = "bbs.workdel.php";
			break;
		case BBS_MODE_WORK_RECOM:
			$BBS_INCLUDE = "bbs.workrecom.php";
			break;
		}
	}

	function START()
	{
		global $SCREEN;
		
		$SCREEN->INIT();
		$SCREEN->START();
		$SCREEN->HEAD();
	}

	function FINISH()
	{
		global $SCREEN;
		
		$SCREEN->BOTTOM();
		$SCREEN->END();
	}

	function MLINK( $CODE )
	{
		global $SCREEN;

		return $SCREEN->MLINK( $CODE );
	}

	function HTMLCLOSE() {
		echo "</html>\n";
	}
	
?>
