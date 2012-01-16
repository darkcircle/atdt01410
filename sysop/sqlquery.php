<?

/*
 * sysop/sqlquery.php
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

	// Rearranged below code due to missing indent

	include "dbconn.php";

	echo "
	<Style>
	body, td { font-size:9pt; }
	</Style>
	";

	echo "
	<A Href=./>메인으로</A><Br>
	<Hr>
	";

	echo "
	쿼리문 : $query<Br>
	";

	$result = mysql_query($query);
	if( mysql_error() ) {
		echo "Error:".mysql_error();
	} else {
		echo "[결과]<Br>";
		$fields = mysql_num_fields($result);
		$rows = mysql_num_rows($result);
		echo "[행: $rows] &nbsp;&nbsp;&nbsp; [필드수: $fields]<Br>";
		echo "<Table border=1>";
		echo "<Tr bgColor=cccccc>";
		for($i=0; $i<$fields; $i++) {
			$fname = mysql_field_name($result,$i);
			echo "<Td>".$fname."</Td>";
		}
		while( $row = mysql_fetch_array($result) ) {
			echo "<Tr>";
			for($i=0; $i<$fields; $i++) {
				echo "<Td>".$row[$i]."</Td>";
			}
		}
		echo "</Table>";
	}
	echo "<Hr>End";
?>
