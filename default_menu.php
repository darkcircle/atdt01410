<?php

	// 이곳에 등록된 메뉴는 페이지 로딩시 자동으로 등록된다.
	// 이곳에 메뉴가 너무 많으면 페이지 로딩이 느려진다.
    // 그럴땐, default_shell.php 파일을 이용.

	// 명령어
	$MENU->ADD( "GO", "GO", "javascript:message('aa'')", "바로가기" );
	$MENU->ADD( "T", "초기화면", "{$SETUP["URL"]}", "초기화면" );	
	$MENU->ADD( "ㅅ", "초기화면", "{$SETUP["URL"]}", "초기화면" );	
	$MENU->ADD( "H", "도움말", "{$SETUP["URL"]}/menu/help.php", "도움말" );	
	$MENU->ADD( "ㅗ", "도움말", "{$SETUP["URL"]}/menu/help.php", "도움말" );	
	$MENU->ADD( "Z", "새로고침", "javascript:document.location=document.location;", "새로고침" );
	$MENU->ADD( "ㅋ", "새로고침", "javascript:document.location=document.location;", "새로고침" );
	$MENU->ADD( "AR","자동새로고침", "javascript:toggle_auto_refresh();", "자동새로고침" );
	$MENU->ADD( "ㅁㄱ","자동새로고침", "javascript:toggle_auto_refresh();", "자동새로고침" );
	$MENU->ADD( "DRAG", "드래그 가능/불가능", "javascript:toggle_auto_focus();", "드래그 가능/불가능" );
	$MENU->ADD( "ㅇㄱㅁㅎ", "드래그 가능/불가능", "javascript:toggle_auto_focus();", "드래그 가능/불가능" );
	$MENU->ADD( "X", "종료", "javascript:window.close();", "01410 종료" );
	
	// 메뉴
	$MENU->ADD( "NETPLAZA", "네티즌광장", "{$SETUP["URL"]}/menu/netplaza/", "네티즌광장" );
	$MENU->ADD( "PLAZA", "큰마을", "{$SETUP["URL"]}/menu/netplaza/plaza.php", "큰마을" );
	$MENU->ADD( "HUMOR", "웃긴게시판", "{$SETUP["URL"]}/menu/netplaza/humor.php", "웃긴게시판" );
	$MENU->ADD( "SIG", "동호회", "{$SETUP["URL"]}/menu/forum/", "동호회" );
	$MENU->ADD( "FORUM", "동호회", "{$SETUP["URL"]}/menu/forum/", "동호회" );
	$MENU->ADD( "SYSOP", "관리자메뉴", "{$SETUP["URL"]}/sysop/", "관리자메뉴" );
	$MENU->ADD( "DEVELOP", "개발실", "{$SETUP["URL"]}/menu/develop/", "01410 개발실" );
	$MENU->ADD( "CONFIG", "설정", "{$SETUP["URL"]}/menu/config/", "설정" );
	$MENU->ADD( "MYSTERY", "불가사의", "{$SETUP["URL"]}/menu/netplaza/mystery.php", "불가사의" );
	$MENU->ADD( "SPORTS", "스포츠", "{$SETUP["URL"]}/menu/netplaza/sports.php", "스포츠" );
	$MENU->ADD( "CHAT", "대화방", "http://dev3.stis.co.kr/TelnetChat/view.html", "대화방" );

	// 바닥메뉴 보기 SETUP 
	$MENU->EDIT( "GO", "BOTTOM", true );
	$MENU->EDIT( "T",  "BOTTOM", true );
	$MENU->EDIT( "Z",  "BOTTOM", true );
	$MENU->EDIT( "AR","BOTTOM", true );
	$MENU->EDIT( "DRAG","BOTTOM", true );
	$MENU->EDIT( "X", "BOTTOM", true );
	
?>
