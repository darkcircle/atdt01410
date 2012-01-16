<?php

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
