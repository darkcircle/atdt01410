<?php

/*
 * default_shell.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea
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

	// ---------------------------------------------------------------
	//  명령어 처리기
	//
	//   자주 쓰이지 않거나, 명령어들이 너무 많을 경우 핵심 명령어들을 
	// 제외한 명령어들은 이곳에 등록해놓는다.
	// ---------------------------------------------------------------

	// ---------------------------------------------------------------
	// 사용자로부터 넘겨받은 명령어 : $CMD
	// ---------------------------------------------------------------
	
	// ---------------------------------------------------------------
	//  지우지 마시오.
	// ---------------------------------------------------------------

	Header("Pragma: no-cache");
	Header("Expires: 0");

	function move( $url )
	{
		echo "
		<script language=\"javascript\">
			parent.page_move( \"{$url}\" );
		</script>";
	}
	
	function message( $msg )
	{
		echo "
		<script language=\"javascript\">
			parent.message( \"{$msg}\" );
		</script>";
	}

	function alert( $msg )
	{
		echo "
		<script language=\"javascript\">
			alert( \"{$msg}\" );
		</script>";
	}
	
	function script( $script )
	{
		echo "
		<script language=javascript>
			{$script};
		</script>";
	}

	if( (! isset($CMD)) or (trim($CMD) == "") ) {
		message( "UNKNOWN" );
		exit();
	}

	$argv = split( " ", $CMD );
	$argc = count($argv);
	
	// ---------------------------------------------------------------
	

	// ---------------------------------------------------------------
	//  이곳에 명령어 등록
	//  argv 와 argc 를 이용.
	// ---------------------------------------------------------------
	
	// 예제
	if( $argv[0] == "go" ) {
		if( $argv[1] == "free" ) {
			move( "http://www.01410.net/menu/netplaza/plaza.php" );
			exit();
		}
	}

	// ---------------------------------------------------------------
	//  bye 명령
	//  X명령은 default_menu 에서 등록하였으나, bye 명령은 
	//  바닥메뉴에 표시할 필요가 없기 때문에, default_shell 에 등록.
	// ---------------------------------------------------------------
	if( $argc == 1 ) {
		if( $argv[0] == "bye" ) {
			script( "parent.close();" );
			exit();
		}
	}

	
	// ---------------------------------------------------------------
	//  URL 이동
	// ---------------------------------------------------------------
	if( substr( $argv[0], 0, 7 ) == "http://" ) move( $argv[0] );
	if( substr( $argv[0], 0, 4 ) == "www." ) 	move( "http://{$argv[0]}" );

	// ---------------------------------------------------------------
	//  없는 명령어 처리
	// ---------------------------------------------------------------
	message( "UNKNOWN" );
?>
