<?php

	include "../default.php";

	$THISPAGE = Array ( "NAME" => "SYSOP",
						"URL"  => "{$SETUP["URL"]}/sysop/",
						"TIP"  => "관리자화면" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->EDIT( "P", "바닥메뉴보기", true );

	$MENU->ADD( "1", "게시판관리", "{$SETUP["URL"]}/sysop/bbs/", "게시판관리" );
	
	START();
?>

    <?=MLINK(1)?> 
	
<?
	FINISH();
?>
