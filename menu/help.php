<?php

/*
 * menu/help.php
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
