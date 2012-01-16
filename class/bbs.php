<?php

/*
 * class/bbs.php
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

	define( BBS_WRITE_NORMAL, 1 );
	define( BBS_WRITE_REPLY,  2 );
	
	define( BBS_ERROR_HIDE, false );
	define( BBS_ERROR_SHOW, true );

	define( BBS_SEARCH_NO, 	  	1 );
	define( BBS_SEARCH_THREAD, 	2 );
	define( BBS_SEARCH_TITLE, 	4 );
	define( BBS_SEARCH_NAME, 	8 );
	define( BBS_SEARCH_TEXT,   16 );
	define( BBS_SEARCH_IP,     32 );
	define( BBS_SEARCH_EMAIL,  64 );
	define( BBS_SEARCH_HOME,  128 );
	define( BBS_SEARCH_RECOM, 256 );
	
	define( BBS_SORT_NO, 	  1 );
	define( BBS_SORT_THREAD,  2 );
	define( BBS_SORT_TITLE,   4 );
	define( BBS_SORT_NAME, 	  8 );
	define( BBS_SORT_HIT, 	 16 );
	define( BBS_SORT_DATE, 	 32 );
	define( BBS_SORT_RECOM,	 64 );
	
	define( BBS_ORDER_ASC,	"ASC"  );
	define( BBS_ORDER_DESC,	"DESC" );

	define( BBS_MODE_LIST, 	 	 1 );
	define( BBS_MODE_VIEW, 	 	 2 );
	define( BBS_MODE_WRITE, 	 3 );
	define( BBS_MODE_REPLY,  	 4 );
	define( BBS_MODE_EDIT, 	 	 5 );
	define( BBS_MODE_DELETE, 	 6 );
	define( BBS_MODE_WORK_SAVE,	 7 );
	define( BBS_MODE_WORK_DEL, 	 8 );
	define( BBS_MODE_WORK_RECOM, 9 );
	define( BBS_MODE_PRINT,		10 );

	class CBBS_CORE
	{
		var $m_bErrorShow;
		var $m_nCount;
		var $m_strSearch;
		var $m_RESULT;
		var $m_PROPERTY;
		var $m_DATA;

		function CBBS_CORE()
		{
			global $SETUP;
			
			$this->m_bErrorShow = $SETUP["BBS_ERROR_SHOW"];
		}

		function ERROR( $ErrStr="" )
		{
			if( $this->m_bErrorShow == BBS_ERROR_SHOW ) {
				if( $ErrStr )
					echo "ERROR! : {$ErrStr}<br>\n";
				echo mysql_error()."<br>\n";
			}
		}

		function GET_COUNT( $PROPERTY="" )
		{
			global $DB;
			
			if( $PROPERTY == "" )
				$PROPERTY = $this->m_PROPERTY;

			$query = "SELECT COUNT(*) FROM {$PROPERTY["TABLE"]}";
			if( $this->m_strSearch )
				$query .= " WHERE {$this->m_strSearch} ";

			$result = $DB->RESULT( $query );
			$this->m_nCount = $result[0];
		
			return $this->m_nCount;
		}
	
		function GET_LASTPAGE()
		{
			global $SETUP;

			if( $this->m_nCount == 0 )
				$this->GET_COUNT();
			
			// ceil :  소수점이 있을경우 무조건 자리올림
			$page = ceil( $this->m_nCount / $SETUP["BBS_LIST_SIZE"] );
			
			return $page;
		}
	
		function GET_PAGEFIRSTNO()
		{
			global $SETUP;

			if( $this->m_nCount == 0 )
				$this->GET_COUNT();

			$first_no = $this->m_nCount - ( ($this->m_PROPERTY["PAGE"]-1) * $SETUP["BBS_LIST_SIZE"] );
			
			return $first_no;
		}
	
		function ADD_HIT( $SET="", $HIT=1 )
		{
			global $DB;
			
			if( ! $SET )
				$SET = $this->m_PROPERTY;
			
			$query  = "UPDATE {$SET["TABLE"]} ";
			$query .= "SET	 HIT=HIT+{$HIT} ";
			$query .= "WHERE  NO={$SET["NO"]} ";
			
			return $DB->QUERY( $query );		
		}
	
		function ADD_RECOM( $SET="", $RECOM=1 )
		{
			global $DB;
			
			if( ! $SET )
				$SET = $this->m_PROPERTY;
			
			$query  = "UPDATE {$SET["TABLE"]} ";
			$query .= "SET	 RECOM=RECOM+{$RECOM} ";
			$query .= "WHERE  NO={$SET["NO"]} ";
			
			return $DB->QUERY( $query );		
		}
	
		function GET_LIST( $PROPERTY )
		{
			global $SETUP, $DB;
			
			## 인수로 넘어온 $PROPERTY 재조정
			###################################################################
			if( !isset( $PROPERTY["SIZE"] ) || $PROPERTY["SIZE"] < 1 ) {
				$PROPERTY["SIZE"] = $SETUP["BBS_LIST_SIZE"];
			}

			if( !isset( $PROPERTY["PAGE"] ) || $PROPERTY["PAGE"] < 1 ) {
				$PROPERTY["PAGE"] = 1;
			}
			###################################################################
			
			## 검색 구문 완성
			###################################################################
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_TITLE ) 
				$SEARCH .= " TITLE LIKE '%".$PROPERTY["SEARCH"]."%' ";	
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_NAME ) 
				$SEARCH .= " NAME LIKE '%".$PROPERTY["SEARCH"]."%' ";
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_TEXT ) 
				$SEARCH .= " TEXT LIKE '%".$PROPERTY["SEARCH"]."%' ";
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_IP ) 
				$SEARCH .= " IP = '".$PROPERTY["SEARCH"]."' ";
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_EMAIL ) 
				$SEARCH .= " EMAIL LIKE '%".$PROPERTY["SEARCH"]."%' ";
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_HOME ) 
				$SEARCH .= " HOME LIKE '%".$PROPERTY["SEARCH"]."%' ";
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_NO ) 
				$SEARCH  = " NO='".$PROPERTY["SEARCH"]."' ";	
			if( $PROPERTY["SEARCH_FIELD"] & BBS_SEARCH_THREAD ) 
				$SEARCH  = " THREAD='".$PROPERTY["SEARCH"]."' ";
			$this->m_strSearch = $SEARCH;
			###################################################################

			## 정렬 구문 완성
			###################################################################
			if( ! $PROPERTY["ORDER_FIELD"] )
				$PROPERTY["ORDER_FIELD"] = BBS_SORT_THREAD;
			if( ! $PROPERTY["ORDER"] )
				$PROPERTY["ORDER"] = BBS_ORDER_DESC;
				
			if( $PROPERTY["ORDER_FIELD"]  == BBS_SORT_THREAD ) 	$ORDER  = "BY THREAD";
			if( $PROPERTY["ORDER_FIELD"]  == BBS_SORT_NO ) 		$ORDER  = "BY NO";
			if( $PROPERTY["ORDER_FIELD"]  == BBS_SORT_TITLE ) 	$ORDER  = "BY TITLE";
			if( $PROPERTY["ORDER_FIELD"]  == BBS_SORT_NAME ) 	$ORDER  = "BY NAME";
			if( $PROPERTY["ORDER_FIELD"]  == BBS_SORT_HIT ) 	$ORDER  = "BY HIT";
			if( $PROPERTY["ORDER_FIELD"]  == BBS_SORT_DATE ) 	$ORDER  = "BY DATE";
			###################################################################
			
			## LIMIT 완성
			###################################################################
			if( ! $PROPERTY["LIMIT"] ) {
				$LIMIT  = ( $PROPERTY["PAGE"]-1 ) * $PROPERTY["SIZE"];
				$LIMIT .= ", ".$PROPERTY["SIZE"];
			} else {
				$LIMIT = $PROPERTY["LIMIT"];
			}
			###################################################################
			
			## query문 완성
			###################################################################
			$QUERY  = "SELECT * FROM {$PROPERTY["TABLE"]}";
			if( $SEARCH != "" )
				$QUERY .= " WHERE $SEARCH";
			
			if( $PROPERTY["BASE"] != "" ) {
				if( $SEARCH != "" ) {
					if( $PROPERTY["POS"] == "DN" )
						$QUERY .= " AND thread < {$PROPERTY["BASE"]} ";
					else if( $PROPERTY["POS"] == "UP" )
						$QUERY .= " AND thread > {$PROPERTY["BASE"]} ";
				} else {
					if( $PROPERTY["POS"] == "DN" )
						$QUERY .= " WHERE thread < {$PROPERTY["BASE"]} ";
					else if( $PROPERTY["POS"] == "UP" )
						$QUERY .= " WHERE thread > {$PROPERTY["BASE"]} ";
				}
				
				if( $ORDER != "" )
					$ORDER .= ", thread ";
				else {
					$QUERY .= " ORDER BY thread ";
					if( $PROPERTY["POS"] == "DN" )
						$QUERY .= "DESC";
					else if( $PROPERTY["POS"] == "UP" )
						$QUERY .= "ASC";
				}
			}
			
			if( $ORDER != "" )
				$QUERY .= " ORDER $ORDER {$PROPERTY["ORDER"]}";
			
			$QUERY .= " LIMIT $LIMIT";
			###################################################################
			$this->m_PROPERTY = $PROPERTY;
			$this->m_RESULT = $DB->QUERY( $QUERY );

			if( $PROPERTY["BASE"] != "" ) {
				if( mysql_num_rows( $this->m_RESULT ) != 1 )
					$this->m_RESULT = false;
				if( $this->m_RESULT ) {
					$this->m_DATA = mysql_fetch_array( $this->m_RESULT );
				}
			}
			
			return $this->m_RESULT;
		}
		
		function DELETE( $PROPERTY )
		{
			global $DB, $SETUP;
			
			if( ! $PROPERTY["NO"] )
				return false;
				
			// 이전 PROPERTY의 패스워드와 FILENAME을 가져옴
			$query = "SELECT PASSWORD, FILENAME FROM {$PROPERTY["TABLE"]} WHERE NO='{$PROPERTY["NO"]}'";
			$result = $DB->RESULT( $query );
			
			$PASSWORD = $result[0];
			$FILENAME = $result[1];
			if( $PROPERTY["PASSWORD"] != $PASSWORD ) {
				return "PASSWORD";
			}

			// 파일 삭제
			if( trim($FILENAME) != "" ) {
				
				$FILEPATH = "{$SETUP["BBS_PDS_PATH"]}/{$PROPERTY["TABLE"]}/{$FILENAME}";
				if( ! unlink( $FILEPATH ) )
					return "FILE";
			}
			
			
			$query = "DELETE FROM {$PROPERTY["TABLE"]} WHERE NO='{$PROPERTY["NO"]}'";
			return $DB->QUERY( $query );
		}
		
		function EDIT( $PROPERTY )
		{
			global $SETUP, $DB, $REMOTE_ADDR;

			if( ! $PROPERTY["NO"] )
				return false;
			
			// 이전 PROPERTY의 패스워드와 FILENAME을 가져옴
			$query = "SELECT PASSWORD, FILENAME FROM {$PROPERTY["TABLE"]} WHERE NO='{$PROPERTY["NO"]}'";
			$result = $DB->RESULT( $query );
			
			$PASSWORD = $result[0];
			$FILENAME = $result[1];

			if( $PROPERTY["PASSWORD"] != $PASSWORD ) {
				return "PASSWORD";
			}
			
			$PROPERTY["IP"] = $REMOTE_ADDR;
			
			// FILE 업로드 처리
			if( $PROPERTY["FILE"] != "none" && trim($PROPERTY["FILE"]) != "" ) {
			
				$FILEPATH = "{$SETUP["BBS_PDS_PATH"]}/{$PROPERTY["TABLE"]}/";
				
				// 이전에 업로드한 FILE 지우기
				if( $FILENAME != "" ) 
					unlink( $FILEPATH.$FILENAME );

				// 새로 업로드한 FILE 저장하기
				$FILENAME = $PROPERTY["FILE_name"];
				if( file_exists( $FILEPATH.$FILENAME ) ) {
					$NO = 0;
					while( 1 ) {
						$test = $NO.$FILENAME;
						if( ! file_exists( $FILEPATH.$test ) ) {
							$FILENAME = $test;
							break;
						}
						++$NO;
					}
				}
				move_uploaded_file( $PROPERTY["FILE"], $FILEPATH.$FILENAME );
				chmod( $FILEPATH.$FILENAME, 0444 );
			}
			
			$query  = "UPDATE {$PROPERTY["TABLE"]} ";
			$query .= "SET TITLE   ='{$PROPERTY["TITLE"]}', ";
			$query .= "    NAME    ='{$PROPERTY["NAME"]}', ";
			$query .= "    EMAIL   ='{$PROPERTY["EMAIL"]}', ";
			$query .= "    HOMEPAGE='{$PROPERTY["HOME"]}', ";
			$query .= "    IP	   ='{$PROPERTY["IP"]}', ";
			$query .= "    TEXT    ='{$PROPERTY["TEXT"]}' ";
			if( $FILENAME ) {
				$query .= ",FILENAME='{$FILENAME}' ";
			}
			$query .= "WHERE NO='{$PROPERTY["NO"]}'";
			
			$result = $DB->QUERY( $query );
			return $result;
		}
		
		function WRITE( $PROPERTY, $TYPE=BBS_WRITE_NORMAL )
		{
			global $SETUP, $DB, $REMOTE_ADDR;
			
			if( $TYPE == BBS_WRITE_REPLY ) {

				// 부모PROPERTY의 THREAD(THREAD), DEPTH(DEPTH) 를 얻어옴
				$query = "SELECT THREAD, DEPTH FROM {$PROPERTY["TABLE"]} WHERE NO='{$PROPERTY["NO"]}'";
				$result = $DB->RESULT( $query );
				
				$P_THREAD = $result[0];
				$P_DEPTH  = $result[1];

				// 부모PROPERTY의 REPLYS(답변수), THREAD(THREAD) 값을 증가시킴
				$query = "UPDATE {$PROPERTY["TABLE"]} SET REPLYS=REPLYS+1 WHERE NO='{$PROPERTY["NO"]}'";
				$result = $DB->QUERY( $query );

				$query = "UPDATE {$PROPERTY["TABLE"]} SET THREAD=THREAD+1 WHERE THREAD>={$P_THREAD}";
				$result = $DB->QUERY( $query );
	
				// 저장할 PROPERTY의 DEPTH(DEPTH) 를 부모PROPERTY의 DEPTH 보다 1 증가한 값으로 넣음
				// -- 출력할때 왼쪽 공간 띄울때 사용
				$PROPERTY["DEPTH"]  = $P_DEPTH+1;

				// THREAD 값을 넣음. 
				$PROPERTY["THREAD"] = $P_THREAD;
				
			} else {
			
				// 일반PROPERTY일 경우 THREAD[PROPERTY순서] 값을 자동으로 설정
				// 리플일 경우 board_reply() DEPTH에서 THREAD 값이 설정됨
				if( $PROPERTY["THREAD"] == 0 ) {
					$query = "SELECT MAX(THREAD) FROM {$PROPERTY["TABLE"]}";
					$result = $DB->RESULT( $query );
					$PROPERTY["THREAD"] = $result[0] + 1;
				}
				
			}
	
			// FILE 업로드 처리
			if( $PROPERTY["FILE"] != "none" && trim($PROPERTY["FILE"]) != "" ) {
				$FILENAME = $PROPERTY["FILE_name"];
				$FILEPATH = "{$SETUP["BBS_PDS_PATH"]}/{$PROPERTY["TABLE"]}/";
				if( file_exists( $FILEPATH.$FILENAME ) ) {
					$NO = 0;
					while( 1 ) {
						$test = $NO.$FILENAME;
						if( ! file_exists( $FILEPATH.$test ) ) {
							$FILENAME = $test;
							break;
						}
						++$NO;
					}
				}
				move_uploaded_file( $PROPERTY["FILE"], $FILEPATH.$FILENAME );
				chmod( $FILEPATH.$FILENAME, 0444 );
			}
		
			if( $PROPERTY["DATE"] == "" )
				$PROPERTY["DATE"] = time();

			$PROPERTY["IP"] = $REMOTE_ADDR;
			
			// query문 완성
			$result  = "INSERT INTO {$PROPERTY["TABLE"]}";
			$result .= " (THREAD, NAME, TITLE, PASSWORD, EMAIL, HOMEPAGE, FILENAME, IP, HIT, REPLYS, DEPTH, DATE, TEXT )";
			$result .= " VALUES ( ";
			$result .= "'{$PROPERTY["THREAD"]}', '{$PROPERTY["NAME"]}', '{$PROPERTY["TITLE"]}',";
			$result .= "'{$PROPERTY["PASSWORD"]}', '{$PROPERTY["EMAIL"]}', '{$PROPERTY["HOME"]}',";
			$result .= "'{$FILENAME}', '{$PROPERTY["IP"]}', '{$PROPERTY["HIT"]}',";
			$result .= "'{$PROPERTY["REPLYS"]}', '{$PROPERTY["DEPTH"]}', '{$PROPERTY["DATE"]}',";
			$result .= "'{$PROPERTY["TEXT"]}' );";

			return $DB->QUERY( $result );
		}
		
	}
	
?>
