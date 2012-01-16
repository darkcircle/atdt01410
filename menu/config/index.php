<?php

	include "../../default.php";

	$SETUP["TITLE"] = "                         설정";

	$THISPAGE = Array ( "NAME" => "CONFIG",
						"URL" => "{$SETUP["URL"]}/menu/config/",
						"TIP" => "설정" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$MENU->ADD( "1", "스타일", "{$SETUP["URL"]}/menu/config/style.php" );
	$MENU->ADD( "2", "HTML 태그", "{$SETUP["URL"]}/menu/config/tag.php" );

	START();
?>

   <?=MLINK(1)?>                         
   <?=MLINK(2)?>                         
	

<?
	FINISH();
?>
