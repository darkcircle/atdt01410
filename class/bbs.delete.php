<?php

/*
 * class/bbs.delete.php
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

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

		// -- 생성자 함수 --------------------------------------------------
		//
		//  * 초기화 및 $PROPERTY 변수 디폴트값 설정
		//
		// -----------------------------------------------------------------
		function CBBS()
		{
			global $SCREEN;

			$this->m_CONFIG["BBS_LIST_DEC_BOTTOM"] = " ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━&nbsp;".$SCREEN->m_strCRLF;
		}

		function PROPERTY( $PROPERTY, $VALUE )
		{
			$this->m_CONFIG[$PROPERTY] = $VALUE;
		}
		
		function ARGUMENT( $SET="" )
		{
			if( ! $SET )
				$SET = $this->m_SET;
			
			$setstr = "?";

			if( $SET["PAGE"]   )		$setstr .= "&PAGE={$SET["PAGE"]}";
			if( $SET["SEARCH"]   )		$setstr .= "&SEARCH={$SET["SEARCH"]}";
			if( $SET["SEARCH_FIELD"] )	$setstr .= "&SEARCH_FIELD={$SET["SEARCH_FIELD"]}";
			if( $SET["ORDER_FIELD"] )	$setstr .= "&ORDER_FIELD={$SET["ORDER_FIELD"]}";
			if( $SET["ORDER"] )			$setstr .= "&ORDER={$SET["ORDER"]}";

			return $setstr;
		}

		// -- 삭제메뉴생성 함수 --------------------------------------------
		//
		//  * 삭제화면에 필요한 메뉴들을 생성 & 등록
		//    - L
		//    - P 변경
		//
		// -----------------------------------------------------------------
		function MAKEMENU( $SET="" )
		{
			global $MENU, $SCREEN, $SETUP;

			if( $SET )
				$this->m_SET = $SET;

			// P 메뉴 EDIT
			$PREV = $PHP_SELF.$this->ARGUMENT();
			$MENU->EDIT( "P", "URL", $PREV ); 
			
			// 메뉴생성
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "글목록" );

			$MENU->ITEMADD( $L );
			
			$L["CODE"] = "ㅣ";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$SCREEN->SET_AUTOFOCUS( false );
			
		}
		
		// -- 삭제화면출력 함수 --------------------------------------------
		//
		//  * 게시물 삭제 화면을 출력한다.
		//
		// -----------------------------------------------------------------
		function SHOW()
		{
			global $PHP_SELF, $SETUP;

			echo "<div class=\"글삭제폼\">\n";
			echo "<form method=post action=\"{$PHP_SELF}".$this->ARGUMENT()."&MODE=".BBS_MODE_WORK_DEL."\" enctype=\"multipart/form-data\">\n";
			
			echo "<input type=hidden name=\"DATA[NO]\" value=\"{$this->m_SET[NO]}\">\n";
			
			echo "<span class=\"글삭제암호입력\">";
			echo "<label class=\"글삭제암호입력\" for=\"글삭제암호입력\">암  호(P)</label><input id=\"글삭제암호입력\" type=password name=\"DATA[PASSWORD]\" class=\"글삭제암호입력\" maxlength=20 accesskey='p'>";
			echo "</span>\n";
			
			echo "<span class=\"글삭제입력완료\">";
			echo "<input type=submit value=\"입력완료(S)\" class=\"글삭제입력완료\" accesskey='s'>";
			echo "</span>\n";

			echo "</form>\n";
			echo "</div>\n";
			
			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
		}
		
	}
	
?>
