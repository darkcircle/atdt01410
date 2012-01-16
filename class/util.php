<?php

/*
 * class/util.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea.
 * Copyright (C) 2012 Seong-ho, Cho, GNOME Korea users group, Republic of Korea.
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

	define( ALIGN_LEFT, 	1 );
	define( ALIGN_RIGHT,	2 );
	
	function SUBSTR_SPC( $LENGTH, $TARGET, $ALIGN=ALIGN_LEFT )
	{
		//$result = SUBSTR_KOR( $LENGTH, $TARGET );
		$result = mb_strcut( $TARGET, 0, $LENGTH );
		//$result = han_substr( $TARGET, $LENGTH, "" );

		// 한글일 경우 2글자를 자르므로... 모자랄 경우 공백을 추가해줌.
		
		$result_length = strlen($result);
		if( $result_length < $LENGTH ) {
			if( $ALIGN == ALIGN_RIGHT ) {
				for( $i=$LENGTH; $i>$result_length; $i-- )
					$result = " ".$result;
			} else {
				for( $i=$result_length; $i<$LENGTH; $i++ )
					$result .= " ";
			}
		}
		
		return $result;
	}

	function SUBSTR_KOR( $LENGTH, $TARGET )
	{	
		return mb_strcut( $TARGET, 0, $LENGTH );
	}


	// reformed below code due to invalid indent
 
	function han_substr($string, $limit_length, $suffix) 
	{

		$string_length = strlen($string);

		if($limit_length < $string_length ) {
			$string = substr( $string, 0, $limit_length );
		} else {
			return $string; 
		}

		for($i=0, $han_char=0; $i < $limit_length; $i++) {
			if( ord($string[$i]) > 127 ) 
				$han_char++;
		}

		$r = $han_char % 3;
		$limit_length = $limit_length - $r;
		$string = substr($string, 0, $limit_length) . ' ' . $suffix;
		return $string;
	}

	// 유니코드용 문자열 잘라먹기 함수
	function cut_string_for_utf8( $max_len, $str )
	{
	       $n = 0;
	       $noc = 0;
	       $len = strlen($str);
	       while ( $n < $len )
	       {
		      $t = ord($str[$n]);
		      if ( $t == 9 || $t == 10 || (32 <= $t && $t <= 126) )
		      {
		             $tn = 1;
		             $n++;
		             $noc++;
		      }
		      else if ( 194 <= $t && $t <= 223 )
		      {
		             $tn = 2;
		             $n += 2;
		             $noc += 2;                     
		      }
		      else if ( 224 <= $t && $t < 239 )
		      {
		             $tn = 3;
		             $n += 3;
		             $noc += 2;
		      }
		      else if ( 240 <= $t && $t <= 247 )
		      {
		             $tn = 4;
		             $n += 4;
		             $noc += 2;
		      }
		      else if ( 248 <= $t && $t <= 251 )
		      {
		             $tn = 5;
		             $n += 5;
		             $noc += 2;
		      }
		      else if ( $t == 252 || $t == 253 )
		      {
		             $tn = 6;
		             $n += 6;
		             $noc += 2;
		      }
		      else { $n++; }
		      
		      if ( $noc >= $max_len ) {
		             break;
		      }

	       }
	       if ( $noc > $max_len ) { $n -= $tn; }

	       return substr($str, 0, $n);
	}
	
?>
