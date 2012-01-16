<?php

/*
 * sysop/bbs/db.sql
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

	$addsql1 = "
	create table ";

	$addsql2 = "
	(
		no			int(11) DEFAULT '0' NOT NULL auto_increment,
		title		varchar(127) NOT NULL,
		name		varchar(20) NOT NULL,
		date		int(11) NOT NULL,
		ip			varchar(15) NOT NULL,
		hit			int(13) DEFAULT '0' NOT NULL,
		email		varchar(127),
		text		text NOT NULL,
		password	varchar(20),
		homepage	varchar(127),
		depth		int(11) DEFAULT '0' NOT NULL,
		replys		int(11) DEFAULT '0' NOT NULL,
		thread		int(11) NOT NULL,
		filename	varchar(255),
		recom		int(11) DEFAULT '0',
		PRIMARY KEY	(no),
		INDEX		(thread),
		INDEX		(name),
		INDEX		(title),
		INDEX		(no)
	);";
?>
