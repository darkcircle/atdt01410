<?

/*
 * menu/config/cookie.php
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
