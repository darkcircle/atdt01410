<?php

/*
 * sysop/index.php
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
