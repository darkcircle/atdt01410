<?php

	include "../../default.php";

	$SETUP["TITLE"] = "                      네티즌광장";

	$THISPAGE = Array ( "NAME" => "NETPLAZA",
						"URL" => "{$SETUP["URL"]}/menu/netplaza/",
						"TIP" => "네티즌과장" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$MENU->ADD( "1", "큰마을(PLAZA)", "{$SETUP["URL"]}/menu/netplaza/plaza.php" );
	$MENU->ADD( "2", "웃긴게시판(HUMOR)", "{$SETUP["URL"]}/menu/netplaza/humor.php" );
	$MENU->ADD( "3", "불가사의(MYSTERY)", "{$SETUP["URL"]}/menu/netplaza/mystery.php" );
	$MENU->ADD( "4", "스포츠(SPORTS)", "{$SETUP["URL"]}/menu/netplaza/sports.php" );

	START();
?>
   <font class=볼록위>━━━━━━━━━━</font>
   <font class=역상>    떠들어보세~~    </font>
   <font class=볼록아래>━━━━━━━━━━</font>
   <?=MLINK(1)?>                         
   
   
   <font class=볼록위>━━━━━━━━━━</font>
   <font class=역상>    테마  게시판    </font>
   <font class=볼록아래>━━━━━━━━━━</font>
   <?=MLINK(2)?>                         
   <?=MLINK(3)?>                         
   <?=MLINK(4)?>                         
	

<?
	FINISH();
?>
