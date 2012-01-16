<?php

/*
 * menu/netplaza/index.php
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
