<?php

	include "../../default.php";

	$SETUP["TITLE"] = "                         설정";

	$THISPAGE = Array ( "NAME" => "CONFIG",
						"URL" => "{$SETUP["URL"]}/menu/config/",
						"TIP" => "설정" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}/menu/config/", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}/menu/config/", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$CSS = Array(	"http://www.01410.net/style/default.css",
					"http://www.01410.net/style/hitelfont.css",
					"http://www.01410.net/style/fixedfont.css"
				);
	
	for( $i=0; $i<count($CSS); $i++ ) {
		$NAME = $CSS[$i];
		$URL  = "{$SETUP["URL"]}/menu/config/cookie.php?location=$PHP_SELF&CSS=".$CSS[$i];
		$MENU->ADD( $i+1, $NAME, $URL);
	}

	START();

	echo "\n";
	echo "    현재 스타일: ".$_COOKIE["COOKIE_CSS"];
	
	echo "\n\n";

	for( $i=0; $i<count($CSS); $i++ ) {
		echo "    ";
		echo MLINK($i+1);
		echo "\n";
	}
?>
    <form method=post action=cookie.php style="margin:0;">
    사용자 정의 스타일(DRAG모드를 해제 하시고 입력하세요.)
    <input type=text name=CSS value='http://' style="width:400;"> <input type=submit value='설정하기'>
	</form>
<?
	FINISH();
?>
