<!--
/*
 * sysop/bbs/index.php
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
 *
 * Rearranged source code due to missing indent
 */ 
-->

<A Href="../">SYSOP 처음으로</a><br>
<br>
<A Href="../dbm/index.php">Table 목록 보기</A>

<Form Method=post Action='bbs_add.php'>
MySQL에 WebispyBoard DB Table 추가<Br>
Table Name<Input Type=text Name=boardid>
<Input Type=submit value='추가'>
</Form>

<Form Method=post Action='bbs_del.php'>
MySQL에 WebispyBoard DB Table 지우기<Br>
Table Name<Input Type=text Name=boardid>
<Input Type=submit value='지우기'>
</Form>

