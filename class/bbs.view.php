<?php

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

		// for 보기
		var $DATA;

		function CBBS()
		{
			global $SCREEN;
			
			$this->m_CONFIG["BBS_VIEW_HEAD_DEC_BOTTOM"] = " ───────────────────────────────────────".$SCREEN->m_strCRLF;

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

		// -- 보기쉘등록 함수 ----------------------------------------------
		//
		//  * 게시판 글보기 모드에서만 사용되는 함수 처리기 등록
		//
		// -----------------------------------------------------------------
		function ADD_USER_SHELL()
		{
			global $PHP_SELF;

			echo "<script language=\"javascript\">
	
	// 
	var obj;
			
	function user_shell( argc, argv )
	{
		if( ! obj ) {
			obj = document.getElementById( 'content' );
			if( ! obj ) 
				return false;
		}
		
		if( argv == 0 ) {

			obj.doScroll( \"pageDown\" );

			return true;
		}

		if( argc == 1 ) {
			if( argv[0] == \"b\" || argv[0] == \"ㅠ\" ) {
				obj.doScroll( \"pageUp\" );

				return true;
			}
		}
		
		return false;
	}
</script>";
		}
		
		
		// -- 보기메뉴생성 함수 --------------------------------------------
		//
		//  * 보기MODE에 필요한 메뉴들을 생성 & 등록
		//    - L, W, R, E, D, DN, MAIL, HOME
		//    - P 변경
		//
		// -----------------------------------------------------------------
		function MAKEMENU( $SET="" )
		{
			global $PHP_SELF, $MENU, $SETUP;
			
			$this->m_SET = $SET;
			
			if( $SET["NO"] != "" ) {
				$SET["SEARCH_FIELD"] = BBS_SEARCH_NO;
				$SET["SEARCH"] = $SET["NO"];
			}
			
			$SET["ORDER_FIELD"] = " ";
			$SET["LIMIT"] = "1";

			// 이전글, 다음글 명령일 경우, 글을 찾은 다음에 조회수를 올린다.
			if( $SET["BASE"] == "" )	
				$this->ADD_HIT( $SET );
			
			// 글 얻기
			$this->GET_LIST( $SET );
			
			if( ! $this->m_RESULT )
				return false;
			
			
			// 
			if( $SET["BASE"] != "" ) {
				$DATA = $this->m_DATA;

				// m_PROPERTY 변수 변경
				$this->m_PROPERTY["NO"] = $DATA["no"];
				$this->ADD_HIT( $this->m_PROPERTY );

				// SET 변수 변경
				$SET["NO"] = $DATA["no"];
				$SET["THREAD"] = $DATA["thread"];
			} else {
				$DATA = mysql_fetch_array( $this->m_RESULT );
			}
		
			if( ! isset($SET["THREAD"]) )
				$SET["THREAD"] = $DATA["thread"];

			// 태그 허용/허용하지 않음 처리
			if( $_COOKIE["COOKIE_BOARD_VIEW_TAG"] == 1 ) {
				$DATA["title"] = str_replace( "<", "&lt;", $DATA["title"] );
				$DATA["name"] = str_replace( "<", "&lt;", $DATA["name"] );
			}
			
			$DATA["NO"] = $DATA["no"];
			$DATA["TITLE"] = $DATA["title"];
			$DATA["NAME"] = SUBSTR_SPC( 20, $DATA["name"] );
			if( $DATA["email"] )
				$DATA["NAME"] = "<a href=\"mailto:{$DATA["email"]}\" class=\"메뉴\" title=\"메일 보내기\">{$DATA["NAME"]}</a>";
			
			$DATA["HIT"] = SUBSTR_SPC( 4, $DATA["hit"] );
			$DATA["DATE"] = date("Y년 m월 d일 H시 i분 s초", $DATA["date"]);	
			$DATA["IP"]   = SUBSTR_SPC( 15, $DATA["ip"] );
			$DATA["TEXT"] = $DATA["text"];
			
			if( $DATA["filename"] ) {
				$DATA["FILEURL"] = "{$SETUP["BBS_PDS_URL"]}/{$SET["TABLE"]}/{$DATA["filename"]}";
				$DATA["FILE"] = "<a href=\"{$DATA["FILEURL"]}\" class=\"메뉴\" title=\"파일 받기\">{$DATA["filename"]}</a>";
			} else
				$DATA["FILE"] = "없음";
				
			if( $DATA["homepage"] != "http://" && $DATA["homepage"] != "" )
				$DATA["HOME"] = "[<a href=\"{$DATA["homepage"]}\" target=_blank class=\"메뉴\" title=\"홈페이지 새창으로 열기\">홈페이지</a>]";
			
			if( $SET["RECOM"] ) {
				$DATA["RECOM"] = "추천: ".SUBSTR_SPC( 4, $DATA["recom"] );
			}
			
			$this->DATA = $DATA;
			
			// P 메뉴 편집
			$PREV = $PHP_SELF.$this->ARGUMENT();
			$MENU->EDIT( "P", "URL", $PREV ); 
			$MENU->EDIT( "ㅔ", "URL", $PREV ); 
		
			// 메뉴생성
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "글목록" );
			
			$W  = Array ( "CODE" => "W",  "NAME" => "W",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_WRITE,
						  "BOTTOM" => true,
						  "TIP" => "글쓰기" );
			
			$R  = Array ( "CODE" => "R",  "NAME" => "R",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_REPLY,
						  "BOTTOM" => true,
						  "TIP" => "답변쓰기" );
			
			$E  = Array ( "CODE" => "E",  "NAME" => "E",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_EDIT,
						  "BOTTOM" => true,
						  "TIP" => "글수정" );
			
			$DD = Array ( "CODE" => "DD",  "NAME" => "DD",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_DELETE,
						  "BOTTOM" => true,
						  "TIP" => "글삭제" );
			
			$MAIL  = Array( "CODE" => "MAIL",  "NAME" => "MAIL",
						  	"URL" => "mailto:{$DATA["email"]}",
						  	"BOTTOM" => true,
						  	"TIP" => "메일 보내기" );
				
			$DN  = Array( "CODE" => "DN",  "NAME" => "DN",
						  "URL" => "{$DATA["FILEURL"]}",
						  "BOTTOM" => true,
						  "TIP" => "파일 받기" );
			
			$HOME = Array( "CODE" => "HOME",  "NAME" => "HOME",
						   "URL" => "{$DATA["homepage"]}",
						   "BOTTOM" => true,
						   "TIP" => "홈페이지 열기" );
		
				
			$OK = Array( "CODE" => "OK", "NAME" => "OK",
						 "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_WORK_RECOM,
						 "BOTTOM" => true,
						 "TIP" => "추천하기" );
		
			$A = Array( "CODE" => "A", "NAME" => "A",
						"URL" => $PHP_SELF.$this->ARGUMENT()."&BASE={$SET["THREAD"]}&MODE=".BBS_MODE_VIEW."&POS=UP",
						"BOTTOM" => true,
						"TIP" => "윗글" );
			
			$N = Array( "CODE" => "N", "NAME" => "N",
						"URL" => $PHP_SELF.$this->ARGUMENT()."&BASE={$SET["THREAD"]}&MODE=".BBS_MODE_VIEW."&POS=DN",
						"BOTTOM" => true,
						"TIP" => "윗글" );
			
			$PR = Array( "CODE" => "PR", "NAME" => "PR",
						 "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&THREAD={$SET["THREAD"]}&MODE=".BBS_MODE_PRINT,
						 "BOTTOM" => true,
						 "TIP" => "출력" );
			
			$B = Array( "CODE" => "B", "NAME" => "B",
						"URL" => "javascript:run_command('b');",
						"BOTTOM" => true,
						"TIP" => "전페이지" );
						
			$MENU->ITEMADD( $L );
			$MENU->ITEMADD( $W );
			$MENU->ITEMADD( $R );
			$MENU->ITEMADD( $E );
			$MENU->ITEMADD( $DD );
			$MENU->ITEMADD( $A );
			$MENU->ITEMADD( $N );
			$MENU->ITEMADD( $PR );
			$MENU->ITEMADD( $B );

			$L["CODE"] = "ㅣ";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$W["CODE"] = "ㅈ";
			$W["BOTTOM"] = false;
			$MENU->ITEMADD( $W );
			
			$R["CODE"] = "ㄱ";
			$R["BOTTOM"] = false;
			$MENU->ITEMADD( $R );
			
			$E["CODE"] = "ㄷ";
			$E["BOTTOM"] = false;
			$MENU->ITEMADD( $E );
			
			$D["CODE"] = "ㅇ";
			$D["BOTTOM"] = false;
			$MENU->ITEMADD( $D );
			
			$A["CODE"] = "ㅁ";
			$A["BOTTOM"] = false;
			$MENU->ITEMADD( $A );

			$N["CODE"] = "ㅜ";
			$N["BOTTOM"] = false;
			$MENU->ITEMADD( $N );

			if( $SET["RECOM"] ) {
				$MENU->ITEMADD( $OK );
				$OK["CODE"] = "ㅐㅏ";
				$OK["BOTTOM"] = false;
				$MENU->ITEMADD( $OK );
			}
			
			if( $DATA["email"] ) 
				$MENU->ITEMADD( $MAIL );
			if( $DATA["filename"] )
				$MENU->ITEMADD( $DN );
			if( $DATA["homepage"] )
				$MENU->ITEMADD( $HOME );
		}
		
		// -- 보기MODE출력 함수 --------------------------------------------
		//
		//  * 게시물 보기 MODE을 출력한다.
		//    - MODE출력() 함수에 의해 호출.
		//
		// -----------------------------------------------------------------
		function SHOW( )
		{
			global $SCREEN, $NO, $MODE;

			$DATA = $this->DATA;

			if( ! $DATA["NO"] ) {
				echo "{$NO}번 글은 존재하지 않습니다.";
				echo $SCREEN->m_strCRLF;
				return true;
			}

			// 글보기에서만 사용되는 명령어 추가
			$this->ADD_USER_SHELL();
			
			// 글내용 출력
			echo $this->m_CONFIG["BBS_VIEW_HEAD_DEC_TOP"];
			echo " 제목: {$DATA["TITLE"]}{$SCREEN->m_strCRLF}";
			echo " 이름: {$DATA["NAME"]}    조회: {$DATA["HIT"]}   I P : {$DATA["IP"]}    {$DATA["HOME"]}";
			echo $SCREEN->m_strCRLF;
			
			if( $DATA["RECOM"] )
				echo " 날짜: {$DATA["DATE"]}      {$DATA["RECOM"]}  파일: {$DATA["FILE"]}";
			else
				echo " 날짜: {$DATA["DATE"]}      파일: {$DATA["FILE"]}";
			echo $SCREEN->m_strCRLF;
			
			echo $this->m_CONFIG["BBS_VIEW_HEAD_DEC_BOTTOM"];

			if( $MODE != BBS_MODE_PRINT )
				echo "<div class=\"글내용\" id=\"content\"><pre>";
			else
				echo "<div class=\"글내용출력\" id=\"content\"><pre>";
			
			echo $DATA["TEXT"];
			
			$FILENAME = split( "\.", $DATA["filename"] ) ;
			$FILEEXT  = strtoupper( $FILENAME[1] );

			if( $FILEEXT == "JPG" || $FILEEXT == "GIF" || $FILEEXT == "BMP"  || $FILEEXT == "PNG" ) {
				echo "<br><img src='{$DATA["FILEURL"]}' alt='{$DATA["FILEURL"]}'><br>";
			}
			
			echo "</pre></div>";

			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
		}
		
		
	}
	
?>
