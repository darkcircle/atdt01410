<?php

/*
 * class/main.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

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
