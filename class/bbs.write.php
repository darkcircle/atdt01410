<?php

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

		// for 보기
		var $DATA;

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

		// -- 쓰기메뉴생성 함수 --------------------------------------------
		//
		//  * 쓰기MODE에 필요한 메뉴들을 생성 & 등록
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
			$MENU->EDIT( "ㅔ", "URL", $PREV ); 
			
			// 메뉴생성
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "글목록" );

			$MENU->ITEMADD( $L );
			$SCREEN->SET_AUTOFOCUS( false );
			
			// 답변쓰기 or 수정 MODE일 경우, 원글을 읽어온다.
			if( $SETUP["BBS_MODE"] == BBS_MODE_REPLY ||
				$SETUP["BBS_MODE"] == BBS_MODE_EDIT ) {

				$SET = $this->m_SET;
				$SET["SEARCH_FIELD"] = BBS_SEARCH_NO;
				$SET["SEARCH"] = $SET["NO"];
				$SET["ORDER_FIELD"] = " ";
				$SET["LIMIT"] = "1";
				$this->GET_LIST( $SET );
			
				if( ! $this->m_RESULT )
					return false;

				$DATA = mysql_fetch_array( $this->m_RESULT );

				if( $SETUP["BBS_MODE"] == BBS_MODE_REPLY ) {
					$DATA["text"] = "\n\n---- {$DATA["name"]}님께서 쓰신 원본글 ----\n".$DATA["text"];
					$DATA["title"] = "";
					$DATA["name"] = "";
					$DATA["email"] = "";
					$DATA["filename"] = "";
					$DATA["homepage"] = ""; 
				}
				
				$this->DATA = $DATA;
			}
			
		}
		
		// -- 쓰기MODE출력 함수 --------------------------------------------
		//
		//  * 게시물 쓰기 MODE을 출력한다.
		//    - MODE출력() 함수에 의해 호출.
		//
		// -----------------------------------------------------------------
		function SHOW()
		{
			global $PHP_SELF, $SETUP;

			echo "<div class=\"글쓰기폼\">\n";
			echo "<form method=post action=\"{$PHP_SELF}".$this->ARGUMENT()."&MODE=".BBS_MODE_WORK_SAVE."\" enctype=\"multipart/form-data\">\n";
			echo "<input type=hidden name=\"DATA[MODE]\" value=\"".$SETUP["BBS_MODE"]."\">\n";

			if( $SETUP["BBS_MODE"] == BBS_MODE_REPLY ||
				$SETUP["BBS_MODE"] == BBS_MODE_EDIT ) {
				echo "<input type=hidden name=\"DATA[NO]\" value=\"{$this->m_SET[NO]}\">\n";
			}
			
			echo "<span class=\"제목입력\">";
			echo "<label class=\"제목입력\" for=\"제목입력\">제  목(T)</label><input id=\"제목입력\" type=text name=\"DATA[TITLE]\" class=\"제목입력\" maxlength=127 accesskey='t' value='{$this->DATA["title"]}'>";
			echo "</span>\n";
			
			echo "<span class=\"이름입력\">";
			echo "<label class=\"이름입력\" for=\"이름입력\">이  름(N)</label><input id=\"이름입력\" type=text name=\"DATA[NAME]\" class=\"이름입력\" maxlength=20 accesskey='n' value='{$this->DATA["name"]}'>";
			echo "</span>\n";
		
			echo "<span class=\"암호입력\">";
			echo "<label class=\"암호입력\" for=\"암호입력\">암  호(P)</label><input id=\"암호입력\" type=password name=\"DATA[PASSWORD]\" class=\"암호입력\" maxlength=20 accesskey='p'>";
			echo "</span>\n";
			
			echo "<span class=\"EMAIL입력\">";
			echo "<label class=\"EMAIL입력\" for=\"EMAIL입력\">E-Mail(E)</label><input id=\"EMAIL입력\" type=text name=\"DATA[EMAIL]\" class=\"EMAIL입력\" maxlength=127 accesskey='e' value='{$this->DATA["email"]}'>";
			echo "</span>\n";
			
			echo "<span class=\"HOME입력\">";
			echo "<label class=\"HOME입력\" for=\"HOME입력\">Home(H)</label><input id=\"HOME입력\" type=text name=\"DATA[HOME]\" class=\"HOME입력\" maxlength=127 accesskey='h' value='{$this->DATA["homepage"]}'>";
			echo "</span>\n";

			if( $this->m_SET["FILEUPLOAD"] ) {
				echo "<span class=\"파일입력\">";
				echo "<label class=\"파일입력\" for=\"파일입력\">파  일(F)</label><input id=\"파일입력\" type=file name=\"DATA[FILE]\" class=\"파일입력\" maxlength=255 accesskey='f'>";
				echo "</span>\n";
			}
			
			echo "<span class=\"내용입력\">";
			echo "<label class=\"내용입력\" for=\"내용입력\">내  용(C)</label>";
			echo "<textarea id=\"내용입력\" name=\"DATA[TEXT]\" class=\"내용입력\" accesskey='c'>{$this->DATA["text"]}</textarea>";
			echo "</span>\n";

			echo "<span class=\"입력완료\">";
			echo "<input type=submit value=\"입력완료(S)\" class=\"입력완료\" accesskey='s'>";
			echo "</span>\n";

			echo "</form>\n";
			echo "</div>\n";
			
			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
		}
		
	}
	
?>
