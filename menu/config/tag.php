<?php

/*
 * menu/config/tag.php
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
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}/menu/config/", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}/menu/config/", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$CSS = Array(	"http://www.01410.net/style/default.css",
					"http://www.01410.net/style/hitelfont.css",
					"http://www.01410.net/style/fixedfont.css"
				);
	

	$MENU->ADD( "1", "글 목록 테그 허용", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDLISTTAG=0&location=$PHP_SELF", "" );
	$MENU->ADD( "2", "글 목록 테그 허용하지 않음", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDLISTTAG=1&location=$PHP_SELF", "" );
	$MENU->ADD( "3", "글 보기 테그 허용", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDVIEWTAG=0&location=$PHP_SELF", "" );
	$MENU->ADD( "4", "글 보기 테그 허용하지 않음", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDVIEWTAG=1&location=$PHP_SELF", "" );

	START();

	$LISTTAG = "허용";
	$VIEWTAG = "허용";
	
	if( $_COOKIE["COOKIE_BOARD_LIST_TAG"] == 1 ) {
		$LISTTAG = "허용하지 않음";
	}

	if( $_COOKIE["COOKIE_BOARD_VIEW_TAG"] == 1) {
		$VIEWTAG = "허용하지 않음";
	}

	echo "\n";
	echo "    현재 상태\n";
	echo "     ├글 목록 태그: {$LISTTAG}\n";
	echo "     └글 보기 태그: {$VIEWTAG}\n";

?>

    <?=MLINK(1)?> 
    <?=MLINK(2)?> 

    <?=MLINK(3)?> 
    <?=MLINK(4)?> 
	
<?
	FINISH();
?>
