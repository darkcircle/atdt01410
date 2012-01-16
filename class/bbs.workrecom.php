<?php

/*
 * class/bbs.workrecom.php
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

		function MAKEMENU( $SET="" )
		{
			global $MENU;
			
			if( $SET ) {
				$this->m_SET = $SET;
			}
			
			// P 메뉴 EDIT
			$PREV = $PHP_SELF.$this->ARGUMENT();
			$MENU->EDIT( "P", "URL", $PREV ); 
			$MENU->EDIT( "ㅔ", "URL", $PREV ); 
			
			// 메뉴생성
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "글목록" );

			$MENU->ITEMADD( $L );

			$L["CODE"] = "ㅣ";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			if( trim($SET[NO]) == "" ) {
				$this->m_bState = false;
				return false;
			}

			$this->m_bState = $this->ADD_RECOM( $SET );
			
		}

		function SHOW()
		{
			global $SCREEN;

			$m_bState = "{$this->m_bState}";
			
			if( ! $this->m_bState ) {
				echo " 추천하기 실패 !!!";
				echo $SCREEN->m_strCRLF;
				echo $SCREEN->m_strCRLF;
				echo " 필수 입력 항목이 제대로 입력되지 않았습니다.";
				echo $SCREEN->m_strCRLF;
				echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
				return false;
			}
			
			echo " {$this->m_SET["NO"]}번 글을 추천하였습니다.";
			echo $SCREEN->m_strCRLF;
			echo $SCREEN->m_strCRLF;
			echo " 목록으로 돌아가려면 P를 누르세요.";
			echo $SCREEN->m_strCRLF;
			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
			return true;
		}
		
	}
	
?>
