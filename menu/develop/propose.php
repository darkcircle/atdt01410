<?php

/*
 * menu/develop/propose.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea.
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

	$SETUP["BBS_MODE"]  = $MODE;
	$SETUP["USING_BBS"] = true;
	$SETUP["USING_DB"]  = true;

	include "../../default.php";

	$SETUP["TITLE"] = "                       건의하기";

	$THISPAGE = Array ( "NAME" => "DEVELOP",
						"URL" => "{$SETUP["URL"]}/menu/develop/",
						"TIP" => "개발실" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}/menu/develop/", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}/menu/develop/", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

	// url에서 get방식으로 넘겨받아야 할 항목들
	$SET["TABLE"] 		= "develop_propose";
	$SET["NO"] 			= $NO;
	$SET["THREAD"] 		= $THREAD;
	$SET["PAGE"] 		= $PAGE;
	$SET["SEARCH"] 		= $SEARCH;
	$SET["SEARCH_FIELD"]= $SEARCH_FIELD;
	$SET["ORDER_FIELD"] = $ORDER_FIELD;
	$SET["ORDER"] 		= $ORDER;
	$SET["BASE"]		= $BASE;
	$SET["POS"]			= $POS;

	$SET["FILEUPLOAD"] 	= true;		// 파일 업로드 허용
	$SET["RECOM"] 		= true;		// 추천하기 사용

	// 추천 항목 추가
	$BBS->PROPERTY( "BBS_FIELD_LIST", Array("BBS_FIELD_NO", " ", 
											"BBS_FIELD_NAME", " ", 
											"BBS_FIELD_DATE", " ", 
											"BBS_FIELD_HIT", " ", 
											"BBS_FIELD_RECOM", " ", 
											"BBS_FIELD_TITLE" ) );
	$BBS->PROPERTY( "BBS_FIELD_RECOM", 4 );
	$BBS->PROPERTY( "BBS_FIELD_TITLE", 43 );

	$BBS->MAKEMENU( $SET );
	
	START();
	$BBS->SHOW();
	FINISH();
?>
