<?php

/*
 * menu/develop/index.php
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

	$SETUP["TITLE"] = "                        개발실";

	$THISPAGE = Array ( "NAME" => "DEVELOP",
						"URL" => "{$SETUP["URL"]}/menu/develop/",
						"TIP" => "01410 개발실" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$MENU->ADD( "11", "건의하기", "{$SETUP["URL"]}/menu/develop/propose.php", "건의하기" );
	$MENU->ADD( "12", "매뉴얼  ", "{$SETUP["URL"]}/menu/develop/manual.php", "매뉴얼" );
	$MENU->ADD( "13", "운영하기", "{$SETUP["URL"]}/menu/develop/manage.php", "함께 운영해요~" );
	
	START();
?>

    *******  * *       으하하~
          *  * *
         *   ***
        *    * *
       *     * *       ┌────────┐
                       │ <?=MLINK(11)?>   │     소스공개는 언제하지 -_-..
    *     *  *         │ <?=MLINK(12)?>   │
    *******  *         │ <?=MLINK(13)?>   │
    *     *  ***       └────────┘
    *******  *
	
    **********          아~~
             *            귀.
    **********              찮.
    *                         아.... 이놈의 귀차니즘 언제 고쳐질지 -_-..
    **********       
	
<?
	FINISH();
?>
