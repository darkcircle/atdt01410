<?php

/*
 * class/screen.php
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

	define( CRLF_PRE,	1 );
	define( CRLF_BR,	2 );
	
	class CSCREEN
	{
		var $m_strCSS;
		var $m_strJSCRIPT;
		var $m_strCRLF;
		var $m_strAUTOFOCUS;
		var $m_strONLOAD;
		var $m_strONCLICK;
		var $m_strBODY_TAG;
		var $m_mnuCURRENT;
		var $m_nCRLF;

		function CSCREEN( $mnuCURRENT="" )
		{
			global $_COOKIE, $SETUP;
			
			$this->m_strCSS   	= "";
			$this->m_strJSCRIPT = "";
			$this->m_mnuCURRENT	= $mnuCURRENT;
			$this->set_CRLF( CRLF_PRE );
			$this->set_AUTOFOCUS( true );
			if( $_COOKIE["auto_refresh"] == "auto_refresh" ) {
				$this->m_strONLOAD = " set_refresh(); ";
			}
		}
		
		function ADD_CSS( $url )
		{
			$this->m_strCSS .= "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"{$url}\">\r\n";
		}
	
		function ADD_JSCRIPT( $url )
		{
			$this->m_strJSCRIPT .= "\t\t<script language=\"javascript\" src=\"{$url}\"></script>\r\n";
		}
		
		function INIT( $property="" )
		{
			global $SETUP, $MENU;

			//
			echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\r\n";
			
			// HTML open
			echo "<html>\r\n";
			
			// HEAD open
			echo "\t<head>\r\n";
			
			// TITLE tag
			if( $SETUP["TAG_TITLE"] ) {
				$TITLE = $SETUP["TAG_TITLE"];
				if( $property["TITLE"] )
					$TITLE = $property["TITLE"];
				
				echo "\t\t<title>{$TITLE}</title>\r\n";
			}
			
			// META tag
			echo "\t\t<meta http-equiv=\"Content-Type\" Content=\"text/html; charset=EUC-KR\">\r\n";
		
			// STYLE tag
			echo $this->m_strCSS;

			// 도메인 
			if( $SETUP["DOMAIN"] ) {
				echo "\t\t<script language=\"javascript\">\r\n";
				echo "\t\t\tdocument.domain = \"{$SETUP["DOMAIN"]}\"\r\n";
				echo "\t\t</script>\r\n";
			}
		
			// IE only script - key function
			//echo "\t\t<script language=\"javascript\" for=\"body\" event=\"onkeyup\" src=\"{$SETUP["URL"]}/script/ie_bodyonkeyup.js\"></script>\r\n";
			//echo "\t\t<script language=\"javascript\" for=\"body\" event=\"onkeydown\" src=\"{$SETUP["URL"]}/script/ie_bodyonkeydown.js\"></script>\r\n";

			// Java Script tag
			echo $this->m_strJSCRIPT;
		
			// User Menu 
			echo "\t\t<script language=\"javascript\">\r\n";
			if( $SETUP["DEFAULT_SHELL_FILE"] )
				echo "\t\t\tset_userShellFile( \"{$SETUP["DEFAULT_SHELL_FILE"]}\" );\r\n";
				
			$total = $MENU->GET_COUNT();
			
			for( $i=1; $i<=$total; $i++ ) {
				$item = $MENU->m_MenuBuf[$i];
				
				echo "\t\t\tmenu_add( \"{$item["CODE"]}\", \"{$item["URL"]}\" );\n";
				
				if( $item["GO"] ) 
					echo "\t\t\tgo_add( \"{$item["CODE"]}\", \"{$item["URL"]}\" );\n";
			
				if( $item["ARROWINDEX"] != -1 )
					echo "\t\t\tarrow_add( \"{$item["CODE"]}\", {$item["ARROWINDEX"]} );\n";
			}
			
			echo "\t\t</script>\r\n";

			// HEAD close
			echo "\t</head>\r\n\r\n";
		}
		
		function SET_CRLF( $CRLF )
		{
			$this->m_nCRLF = $CRLF;

			if( $CRLF == CRLF_PRE )
				$this->m_strCRLF = "\r\n";
			else
				$this->m_strCRLF = "<BR />\n";
		}
	
		function SET_BODY_TAG( $tag )
		{
			$this->m_strBODY_TAG = $tag;
		}
		
		function ADD_BODY_ONLOAD( $str )
		{
			$this->m_strONLOAD .= $str;
		}
	
		function SET_AUTOFOCUS( $str )
		{
			if( $str ) {
				$this->m_strONCLICK   = "OnClick=\"auto_focus();\"";
				$this->m_strAUTOFOCUS = "autoFocus=1;";
			} else {
				$this->m_strONCLICK = "";
				$this->m_strAUTOFOCUS = "autoFocus=0;";
			}
		}
		
		function START()
		{
			global $plusargv;

			echo "\t<body {$this->m_strBODY_TAG} OnLoad=\"{$this->m_strAUTOFOCUS} auto_focus(); {$this->m_strONLOAD}\" {$this->m_strONCLICK}>\r\n";
			
			echo "\t<iframe id=\"DEBUG\" name=\"DEBUG\" class=\"디버그\" src=\"about:blank\"></iframe>\r\n";
			
			// 여러단계 거쳐가기 처리
			if( isset($plusargv) && trim($plusargv) != "" ) {
				echo "\t<script language=\"javascript\">\r\n";
				echo "\t\tcmd_check( \"$plusargv\" );\n";
				echo "\t</script>\r\n";
			}
echo $this->m_strCRLF;			
			if( $this->m_nCRLF == CRLF_PRE )
				echo "\t\t<pre>\r\n";
		}
		
		function HEAD( $TITLE="" )
		{
			global $SETUP, $THISPAGE;
		
			if( $THISPAGE["CLASS"] == "" )
				$THISPAGE["CLASS"] = "제목_현재메뉴";

			if( $TITLE )
				echo $TITLE;
			else {
				    //12345678901234567890123456789012345678901234567890123456789012345678901234567890 - 80 columns
				echo $SETUP["TITLE_DECO_TOP"].$this->m_strCRLF;
				echo "<a href=\"{$THISPAGE["URL"]}\" title=\"{$THISPAGE["TIP"]}\" class=\"{$THISPAGE["CLASS"]}\">";
				echo SUBSTR_SPC( 10, $THISPAGE["NAME"] );
				echo "</a>";
				echo SUBSTR_SPC( $SETUP["SIZE_TITLE"], $SETUP["TITLE"] );
				echo SUBSTR_SPC( $SETUP["SIZE_TITLE_RIGHT"], $SETUP["TITLE_RIGHT"], ALIGN_RIGHT );
				echo $this->m_strCRLF;
				echo $SETUP["TITLE_DECO_BOTTOM"].$this->m_strCRLF;
			}
		}
		
		function BOTTOM()
		{
			global $MENU, $SETUP;

			echo "<div class=\"바닥\">";
			echo $SETUP["BOTTOM_DECO_TOP"];
			// 바닥 메뉴
			echo " 번호/명령(";
			$total = $MENU->GET_COUNT();
	
			$bStart = 1;
			for( $i=1; $i<=$total; $i++ ) {
				$item = $MENU->m_MenuBuf[$i];
				if( $item["BOTTOM"] ) {
					
					if( ! $bStart )	echo ",";
					else 			$bStart = 0;
						
					echo "<a href=\"{$item["URL"]}\" title=\"\n{$item["TIP"]}\n\" class=\"바닥메뉴\">";

					echo "{$item["CODE"]}";
						
					echo "</a>";
				}
			}

			echo ")&nbsp;{$this->m_strCRLF}";
			
			// 명령 입력
			echo " 선택(";
			echo "<a href=\"javascript:cmd_check('h');\" title=\"\n도움말\n\" class=\"바닥메뉴\">H:도움말</a>";
			echo ") >> ";
			echo "<input type=text name=\"cmd_input\" class=\"명령입력\" id=\"CMDINPUT\" onkeydown=\"cmd_keydown( event );\" /> {$this->m_strCRLF}";
			echo $SETUP["BOTTOM_DECO_BOTTOM"];

			// 메시지
			echo "<div id=\"MSGBOX\" class=\"메시지박스\"></div>{$this->m_strCRLF}";
			echo "</div>";
		}
		
		function MLINK( $CODE )
		{
			global $MENU;

			$item = $MENU->GET_ITEM( $CODE );
			if( ! $item )
				return false;

			// TAG SETUP
			$TAG  = "<a href=\"{$item["URL"]}\"";
			if( $item["SHOWMODE"] & MENU_SHOW_TIP )
				$TAG .= " title=\"{$item["TIP"]}\"";
			if( $item["CLASS"] ) {
				$TAG .= " class=\"{$item["CLASS"]}\"";
			}
			if( $item["TAG"] )
				$TAG .= " {$item["TAG"]}";
			$TAG .= ">";
			
			// 링크 내용 SETUP
			if( $item["SHOWMODE"] & MENU_SHOW_CODE ) 
				$TEXT = $item["CODE"];
				
			if( $item["SHOWMODE"] & MENU_SHOW_NAME ) {
				if( $TEXT )
					$TEXT .= ". ";
				
				$TEXT .= $item["NAME"];
			}

			if( $item["SHOWMODE"] & MENU_SHOW_URL ) {
				if( $item["SHOWMODE"] & MENU_SHOW_NAME ) {
					if( $TEXT )
						$TEXT .= "({$item["URL"]})";
					else
						$TEXT .= "{$item["URL"]}";
				} else {
					if( $TEXT )
						$TEXT .= ". {$item["URL"]}";
					else
						$TEXT .= "{$item["URL"]}";
				}
			}
			
			// TAG 닫기
			
			return $TAG.$TEXT."</a>";

		}

		function END()
		{
			if( $this->m_nCRLF == CRLF_PRE )
				echo "</pre>\r\n";
				
			echo "\t</body>\r\n";
		}
		
	}
	
?>
