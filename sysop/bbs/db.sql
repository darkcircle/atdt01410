<?
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
