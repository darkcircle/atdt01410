<?

/*
 * sysop/dbm/index.php
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

	$query = "show tables";
	$result = mysql_query($query);

	echo "
	<Style>
	body, td { font-size:9pt; }
	A:link, A:visited { font-size:9pt; text-decoration:none; }
	A:hover { font-size:9pt; color:yellow; background-color:black; }
	</Style>
	";

	echo "
	<A Href=../>메인으로</A>
	<Hr>
	";

	echo "
	테이블 목록 ( 테이블 이름을 클릭하시면 자세한 정보를 보실 수 있습니다. )<Br>
	";

	echo "
	<Table border=1 cellspacing=0 bordercolordark=white bordercolorlight=black>
	";

	$cnt=0;
	while( $row=mysql_fetch_array($result) ) {
		echo "<Tr>";
		echo "<Td bgColor=gray><font color=white>".$cnt++."</Td>";
		echo "<Td><A Href=showtable.php?tablename=".$row[0].">";
		echo $row[0];
		echo "</A></Td>";
		if( $row=mysql_fetch_array($result) ) {
			echo "<Td bgColor=gray><font color=white>".$cnt++."</Td>";
			echo "<Td><A Href=showtable.php?tablename=".$row[0].">";
			echo $row[0];
			echo "</A></Td>";
		}
		if( $row=mysql_fetch_array($result) ) {
			echo "<Td bgColor=gray><font color=white>".$cnt++."</Td>";
			echo "<Td><A Href=showtable.php?tablename=".$row[0].">";
			echo $row[0];
			echo "</A></Td>";
		}
	}

	echo "
	</Table>
	";

	echo "
	<Br>
	$cnt 개의 테이블이 검색되었습니다.
	";

	echo "<Hr>End";
?>
