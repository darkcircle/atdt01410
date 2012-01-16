<?php

/*
 * menu/forum/index.php
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

	$SETUP["TITLE"] = "                        동호회";

	$THISPAGE = Array ( "NAME" => "FORUM",
						"URL" => "{$SETUP["URL"]}/menu/forum/",
						"TIP" => "동호회" );
	
	$MENU->ADD( "P", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->ADD( "ㅔ", "이전메뉴", "{$SETUP["URL"]}", "이전메뉴" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$MENU->ADD( "99", "동호회신청", "{$SETUP["URL"]}/menu/forum/request.php", "동호회 신청" );
	$MENU->EDIT( "99", "TAG", "style=\"color:yellow;\"" );

	START();
?>
 ┏━<font class="역상">    생활/취미     </font>━┓ ┏━<font class="역상">    정보/컴퓨터   </font>━┓ ┏━<font class="역상"> 지역/대학/기타 </font>━┓
 ┃ 1. 사회/종교         ┃ ┃  9. 학술/교육/투자   ┃ ┃ 16. 지역           ┃
 ┃ 2. 생활/가정         ┃ ┃ 10. 과학/기술        ┃ ┃ 17. 대학(가-바)    ┃
 ┃ 3. 문화/예술         ┃ ┃ 11. 외국어           ┃ ┃ 18. 대학(사-아)    ┃
 ┃ 4. 음악/영상         ┃ ┃ 12. 통신/친목        ┃ ┃ 19. 대학(자-하)    ┃
 ┃ 5. 게임/취미/오락    ┃ ┃ 13. 컴퓨터응용       ┃ ┃ 20. 신규동호회     ┃
 ┃ 6. 레저/여행         ┃ ┃ 14. 컴퓨터OS         ┃ ┃ 21. 하.동.연       ┃
 ┃ 7. 스포츠            ┃ ┃ 15. 컴퓨터프로그래밍 ┃ ┃                    ┃
 ┃ 8. 의료/건강         ┃ ┗━━━━━━━━━━━┛ ┗━━━━━━━━━━┛
 ┗━━━━━━━━━━━┛ 
   91. 공지사항
   92. 동호회 이용안내
   <?=MLINK(99)?> 
	
<?
	FINISH();
?>
