<?

/*
 * sysop/dbm/deletetable.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea.
 * Copyright (C) 2012, Seong-ho, Cho, GNOME Korea users group, Republic of Korea.
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
 *
 * Rearranged source code due to missing indent
 */

	$SETUP["USING_DB"] = true;
	include "../../default.php";

	$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

	$query = "drop table $tablename";

	$result = mysql_query($query);

	if( mysql_error() ) {
		echo "Error:".mysql_error();
	} else {
		echo "<A Href=index.php>목록으로</A><Hr>";
		echo "Ok.";
	}
?>
