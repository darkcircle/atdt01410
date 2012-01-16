/*
아으.. 썅.. 이거 왜 안되지. -_-
open.ssu.ac.kr에서는 잘 됐는데 -_- 
쩝.. 안해!
*/

	key = event.keyCode;

	alt = 0;
	ctrl = 0;
	shift = 0;

    if( event.altKey )      alt=1;
    if( event.ctrlKey )     ctrl=1;
    if( event.shiftKey )    shift=1;

	content = document.getElementById( "content" );

    if( ! content ) {
        return true;
    }

    // 오른쪽 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==39 ) {
        content.doScroll("scrollbarRight");
    }

    // 왼쪽 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==37 ) {
        content.doScroll("scrollbarLeft");
    }

    // 위로 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==38 ) {
        content.doScroll("scrollbarUp");
    }

    // 아래로 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==40 ) {
        content.doScroll("scrollbarDown");
    }

    // 페이지업 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==33 ) {
        content.doScroll("scrollbarPageUp");
    }

    // 페이지다운 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==34 ) {
        content.doScroll("scrollbarPageDown");
    }

    // HOME 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==36 ) {
        content.doScroll("scrollbarPageLeft");
    }

    // END 스크롤
    if( shift==1 && alt==1 && ctrl==0 && key==35 ) {
        content.doScroll("scrollbarPageRight");
    }

    // 확대( + 키 )
    if( shift==1 && alt==1 && ctrl==0 && key==107 ) {
        updateZoom( document.getElementById("content"), 1 );
    }

    // 축소( - 키 )
    if( shift==1 && alt==1 && ctrl==0 && key==109 ) {
        updateZoom( document.getElementById("content"), -1 );
    }

