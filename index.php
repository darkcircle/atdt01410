<?php

/*
 * index.php
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
