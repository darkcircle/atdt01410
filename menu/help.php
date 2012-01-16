<?php

	include "../default.php";

	$SETUP["TITLE"] = "                        도움말";

	$THISPAGE = Array ( "NAME" => "HELP",
						"URL" => "{$SETUP["URL"]}/menu/help.ph",
						"TIP" => "도움말" );

	$MENU->ADD( "P", "이전메뉴", "javascript:history.go(-1);", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "javascript:history.go(-1);", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	START();
?>
<div class="내용" id="content"><pre>
도움말

 -- 기본 명령어 --
 GO
 T
 Z
 AR
 DRAG
 P

 -- 게시판 명령어 --
 LT
 LN
 LC
 PG
 L
 W
 R
 E
 D
 OK
 HOME
 DN
 EMAIL
 
</pre></div>
 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 
<?
	FINISH();
?>
