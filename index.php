<?php

	include "default.php";

	$SETUP["TITLE"] = "                       시작메뉴";

	$THISPAGE = Array ( "NAME" => "TOP",
						"URL"  => "{$SETUP["URL"]}",
						"TIP"  => "초기화면" );
	
	$MENU->ADD( "P", "이전메뉴", "javascript:message('더 이상 뒤로 갈 수 없습니다.');", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "javascript:message('더 이상 뒤로 갈 수 없습니다.');", "이전메뉴" );

	
  	$MENU->ADD( 1, "환경설정", "{$SETUP["URL"]}/menu/config/"  );
	
  	$MENU->ADD( 11, "네티즌광장", "{$SETUP["URL"]}/menu/netplaza/"  );

	$MENU->ADD( 12, "임시대화방", "http://dev3.stis.co.kr/TelnetChat/view.html" );

  	$MENU->ADD( 15, "동호회", "{$SETUP["URL"]}/menu/forum/" );
	
  	$MENU->ADD( 99, "개발실", "{$SETUP["URL"]}/menu/develop/" );
	
	$MENU->EDIT( "P", "바닥메뉴보기", true );

	START();
?>

  <font class="역상"> Ｃommunication  </font> 

  <?=MLINK(11)?>          <?=MLINK(99)?>       <?=MLINK(1)?> 

  <?=MLINK(12)?> 
  
  <?=MLINK(15)?> 
  
 
  ----------------------------------------------------------------------------
  이 사이트는 <font class="역상">모뎀으로 PC통신 하던 사람들의 모임</font> 입니다.
  <b>예의</b>를 갖추고 <b>매너</b>가 살아있는 통신 생활 부탁드립니다. 

<?
	FINISH();
?>
