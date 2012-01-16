<?php

/*
 * menu/config/index.php
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
