<?

/*
 * sysop/bbs/bbs_add.php
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
 */

	// Rearranged below source code due to missing indent

	// DB에 inoboard 테이블을 만듬
	// Add an inoboard table into the database

	$SETUP["USING_DB"] = true;
	include "../../default.php";

	$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

	include "db.sql";

	echo "
	<A Href=./>메인으로</A>
	<Hr>
	";
	$query = $addsql1.$boardid.$addsql2;
	$result = mysql_query($query);
	echo mysql_error();

	echo "
	<Hr>
	End
	";
?>
