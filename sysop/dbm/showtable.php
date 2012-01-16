<?

/*
 * sysop/dbm/showtable.php
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

	$query = "desc ".$tablename;
	$result = mysql_query($query);
	echo "
	<Style>
	body, td { font-size:9pt; }
	</Style>
	";

	echo "
	<A Href=./>목록으로</A>&nbsp;&nbsp;
	<A Href=deletetable.php?tablename=$tablename>테이블 삭제</A><Br>
	<Hr>
	";

	echo "
	테이블 이름: <Font Color=Green>$tablename</Font><br><br>
	";

	echo "
	테이블 속성
	<Table border=1 cellspacing=0 bordercolordark=white bordercolorlight=black >
	<Tr bgColor=gray>
		<Td>&nbsp;</Td>
		<Td><font color=white>필드</Td>
		<Td><font color=white>타입</Td>
		<Td><font color=white>NULL</Td>
		<Td><font color=white>Key</Td>
		<Td><font color=white>Default</Td>
		<Td><font color=white>Extra</Td>
	";

	$i=0;
	while( $row=mysql_fetch_array($result) ) {
		$namestr[$i] = $row[0];
		echo "<Tr>";
		echo "<Td bgColor=gray><font color=white>".$i++."</Td>";
		echo "<Td><font color=red>".$row[0]."&nbsp;</Td>";
		echo "<Td>".$row[1]."&nbsp;</Td>";
		echo "<Td>".$row[2]."&nbsp;</Td>";
		echo "<Td>".$row[3]."&nbsp;</Td>";
		echo "<Td>".$row[4]."&nbsp;</Td>";
		echo "<Td>".$row[5]."&nbsp;</Td>";
	}

	echo "
	</Table>
	<Br>
	";

	// 테이블 내용 보여주기
	echo "테이블 내용: 10개만 보여줌";
	//$query = "SELECT * from ".$tablename." order by no desc LIMIT 0,10";
	$query = "SELECT * from ".$tablename." LIMIT 0,10";
	$result = mysql_query($query);

	echo "
	<Table border=1 cellspacing=0 bordercolordark=white bordercolorlight=black >
	<Tr bgColor=cccccc>
	";
	$max = $i;
	for($i=0; $i<$max; $i++) {
		echo "<Td><font color=red><b>".$namestr[$i]."&nbsp;</Td>";
	}

	while( $row=mysql_fetch_array($result) ) {
		echo "<Tr>";
		for($i=0; $i<$max; $i++) {
			echo "<Td>".$row[$i]."&nbsp;</Td>";
		}
	}
	echo "
	</Table>
	";

	echo "<Hr>End";
?>
