<?
$EXPIRE = 2114348400;	// mktime( 0, 0, 0, 1, 1, 2037 );

if( isset($CSS) ) {
	setcookie( "COOKIE_CSS", $CSS, $EXPIRE, "/", ".01410.net" );
}

if( isset($BOARDLISTTAG) ) {
	setcookie( "COOKIE_BOARD_LIST_TAG", $BOARDLISTTAG, $EXPIRE, "/", ".01410.net" );
}

if( isset($BOARDVIEWTAG) ) {
	setcookie( "COOKIE_BOARD_VIEW_TAG", $BOARDVIEWTAG, $EXPIRE, "/", ".01410.net" );
}

Header("Location: $location");
?>
