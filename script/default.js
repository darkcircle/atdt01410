/*********************************************************************
*                                                                    *
*                            자바 스크립트                           *
*                                                                    *
*                                                                    *
*********************************************************************/

// 전역 변수
var MenuCode  = new Array();
var MenuHref  = new Array();
var gMenuCode = new Array();
var gMenuHref = new Array();
var ArrowIndex= new Array();
var cntMenu   = 0;
var cntGMenu  = 0;
var maxArrowIndex = 0;
var curArrowIndex = 0;
var autoFocus = 0;
var userShellFile = "";
var objRefresh;
var autoRefresh;

// ----------------
//  쿠키 관련 함수
// ----------------
function SetCookie(sName, sValue)
{
  //document.cookie = sName+'='+escape(sValue)+'; domain='+self.location.host;
  document.cookie = sName+'='+escape(sValue);
}

function GetCookie(sName)
{
  var aCookie = document.cookie.split("; ");
  for (var i=0; i < aCookie.length; i++)
  {
    var aCrumb = aCookie[i].split("=");
    if (sName == aCrumb[0])
      return unescape(aCrumb[1]);
  };
  return null;
}

// --------------
//  자동 Refresh
// --------------
function toggle_auto_refresh() {
    if( autoRefresh == 1 ) {
        var expires = new Date();

        autoRefresh = 0;
        message( "Auto Refresh OFF" );
        // 쿠키 기록 지우기
        document.cookie = "auto_refresh=;expires="+ expires.toGMTString();
        // 리프레시 off
        window.clearInterval( objRefresh );
    } else {
        autoRefresh = 1;
        message( "Auto Refresh ON - 10 sec" );
        // 쿠키 기록 남기기
        document.cookie = "auto_refresh=auto_refresh";
        // 리프레시 on
        objRefresh = window.setInterval( "auto_refresh()", 10000 );
    }
}

function set_refresh() {
    autoRefresh = 1;
    message( "Auto Refresh ON - 10 sec" );
    // 쿠키 기록 남기기
    document.cookie = "auto_refresh=auto_refresh";
    // 리프레시 on
    objRefresh = window.setInterval( "auto_refresh()", 10000 );
}

function auto_refresh() {
    location.reload();
}

// ---------------------------------------------------------
//  자동 포커스
//  - 마우스 클릭 이벤트시 강제로 CMDINPUT 으로 포커스 이동
// ---------------------------------------------------------
function auto_focus()
{
	cmdobj = document.getElementById( "CMDINPUT" );
	if( cmdobj && autoFocus )
		cmdobj.focus();
}

// --------------------
//  자동 포커스 on/off
// --------------------
function toggle_auto_focus()
{
	autoFocus = ! autoFocus;
	auto_focus();
	if( ! autoFocus )
		message( "드래그 가능" );
	else
		message( "드래그 불가능" );
}

// ---------------
//  자동 새로고침
// ---------------
function aotu_refresh()
{
}

// -----------------------
//  메뉴 추가 
//  - GO 명령어 없이 실행
// -----------------------
function menu_add( code, href )
{
	MenuCode[cntMenu] = code;
	MenuHref[cntMenu] = href;
	++cntMenu;
}

// -------------------------
//  커서키 제어 메뉴 추가
//  - UP/DOWN 키로 메뉴선택
// -------------------------
function arrow_add( code, index )
{
	ArrowIndex[index] = code;
	if( index > maxArrowIndex )
		maxArrowIndex = index;
}

function get_prev_arrow()
{
	var oldcur = curArrowIndex;
	var cur = curArrowIndex;
	
	while(1) {
		cur--;
		if( cur < 0 )
			cur = maxArrowIndex;
		if( cur == oldcur )
			return false;
		
		if( ArrowIndex[cur] ) {
			curArrowIndex = cur;
			return ArrowIndex[cur];
		}
	}
	
	return false;
}

function get_next_arrow()
{
	var oldcur = curArrowIndex;
	var cur = curArrowIndex+1;
	
	while(1) {
		if( ArrowIndex[cur] ) {
			curArrowIndex = cur;
			return ArrowIndex[cur];
		}

		cur++;
		if( cur > maxArrowIndex )
			cur = 0;
		if( cur == oldcur )
			return false;
	}
	
	return false;
}

// ----------------------------------
//  추가적인 명령어 처리기 주소 설정
// ----------------------------------
function set_userShellFile( file )
{
	userShellFile = file;
}

// --------------------------
//  메뉴 추가
//  - GO를 앞에 붙여서 실행
// --------------------------
function go_add( code, href )
{
	gMenuCode[cntGMenu] = code;
	gMenuHref[cntGMenu] = href;
	++cntGMenu;
}


// -----------------------
//  메시지 박스 내용 설정    
// -----------------------
function message( str )
{
	var msgobj = document.getElementById( "MSGBOX" );

	if( ! msgobj )
		return false;
		
	if( str == "UNKNOWN" )
		str = "알 수 없는 명령어입니다.";
		
	msgobj.innerHTML = "&nbsp;"+str;
}

function page_move( url )
{
	message( "페이지를 이동중입니다." );

	document.location.href = url;
	return true;
}

// --------------------------------------------------
//  명령창 입력없이 바로 실행
//  cmd_check(str)로 바로 사용하는 것도 가능하나, 
//  cmd_check(str)의 리턴값으로 인해 페이지가 바뀌는 
//  현상을 방지하기 위해 run_command()를 사용한다.
// --------------------------------------------------
function run_command( str )
{
	cmd_check( str );
}

// --------------------------------
//  명령창에서 입력한 명령어 검사
//  1. 메뉴검사
//  2. GO 메뉴검사
//  3. 사용자 명령 처리기 검사
//  4. 추가적인 명령처리 파일 검사
// --------------------------------
function cmd_check( str )
{
	var cmdobj   = document.getElementById( "CMDINPUT" );
	var debugobj = document.getElementById( "DEBUG" );
	var string;
	var argv = "&plusargv=";

	if( str ) {
		string = "" +str;
		string = string.toLowerCase();
	} else {
		string = cmdobj.value.toLowerCase();

		if( ! cmdobj ) {
			message( "명령 입력박스를 찾을 수 없습니다." );
			return false;
		}
	}

	strarray = string.split(" ");

	// 사용자 정의 명령어 처리기( 우선 순위 1 )
	if( user_shell( strarray.length, strarray ) )
		return true;
	
	// GO 메뉴 검사( 우선 순위 2 )
	if( strarray[0] == "go" && strarray.length > 1 ) {
		for( i=0; i<cntGMenu; i++ ) {
			if( strarray[1] == gMenuCode[i].toLowerCase() ) {
				if( strarray.length > 2 ) {
					// go menu 3 같은 형식의 여러단계 거쳐가기 처리
					for( j=2; j<strarray.length; j++ ) {
						argv += strarray[j] + " ";
					}
				
					if( gMenuHref[i].indexOf("?") == -1 ) {
						argv = "?" + argv;
					}
					
					page_move( gMenuHref[i] +  argv );
				} else {
					page_move( gMenuHref[i] );
				}
				return true;
			}
		}
	} else {
		// 메뉴 검사( 우선 순위 3 )
		for( i=0; i<cntMenu; i++ ) {
			if( strarray[0] == MenuCode[i].toLowerCase() && strarray[0] != "go" ) {
				// menu 3 같은 형식의 여러단계 거쳐가기 처리
				if( strarray.length > 1 ) {
					for( j=1; j<strarray.length; j++ ) {
						argv += strarray[j] + " ";
					}
				
					if( MenuHref[i].indexOf("?") == -1 ) {
						argv = "?" + argv;
					}
					page_move( MenuHref[i] + argv );
				} else {
					page_move( MenuHref[i] );
				}
				return true;
			}
		}
	}


	// 사용자 정의 명령어 처리기( 우선 순위 4 )
	if( user_shell_foot( strarray.length, strarray ) )
		return true;

	
	// 추가적인 명령 처리파일 검사( 우선 순위 5 )
	if( userShellFile != "" ) {
		if( debugobj ) {
			debugobj.src = userShellFile + "?CMD=" + string;
		} else
			message( "추가적인 명령 처리를 할 수 없습니다." );
	} else {
		message( "UNKNOWN" );
	}

}

// -------------------------------
//  추가적인 명령어 분석부분을 
//  사용자가 따로 추가할 수 있다.
//  - 함수를 오버라이딩해서 사용
//  - 리턴값이 false 일 경우
//    잘못된 명령어 오류 표시
// -------------------------------
function user_shell( argc, argv )
{
	// NULL 
	//  - USE Overridding !!!
	return false;
}

// 우선순위가 낮음
function user_shell_foot( argc, argv )
{
	return false;
}

// ----------------------------------
//  명령어 입력 처리 
//  - 엔터키 입력시 cmd_check() 호출
// ----------------------------------
function cmd_keydown( e )
{
	var keyCode;
	var cmdobj;
	
	if( e.keyCode )
		keyCode = e.keyCode;
	else if( e.charCode )
		keyCode = e.charCode;
	else 
		keyCode = e.which;

	// Up Arrow
	if( keyCode == 38 ) {
		tt = get_prev_arrow();
		if( tt ) {
			cmdobj = document.getElementById( "CMDINPUT" );
			cmdobj.value = tt;
		}
	}

	// Down Arrow
	if( keyCode == 40 ) {
		tt = get_next_arrow();
		if( tt ) {
			cmdobj = document.getElementById( "CMDINPUT" );
			cmdobj.value = tt;
		}
	}
	
	if( keyCode == 13 ) {
		message("");

		cmd_check();
	
		// 입력한 명령어 지우기
		cmdobj = document.getElementById( "CMDINPUT" );
		if( cmdobj ) {
			cmdobj.value = "";
		}
	}
	
	return true;
}

