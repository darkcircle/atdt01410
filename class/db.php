<?php

/*
 * class/db.php
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

	class CDB
	{
		var $m_bConnect;
		var $m_queryResult;
		
		function CDB()
		{
			$this->m_bConnect = false;
		}

		function CONNECT( $SERVER, $ACCOUNT, $PASSWORD, $DATABASE )
		{
			$result = mysql_connect( $SERVER, $ACCOUNT, $PASSWORD );
			if( ! $result ) 
				return false;
			
			$this->m_bConnect = true;

			return $this->DATABASE( $DATABASE );
		}

		function DATABASE( $DATABASE )
		{
			$result = mysql_select_db( $DATABASE );
			if( ! $result ) 
				$this->ERROR();
			
			return $result;
		}
	
		function ERROR( $message="" )
		{
			global $SETUP;

			if( $SETUP["MYSQL_ERROR_SHOW"] ) {
				if( $message )
					echo "ERROR - $message <br>\n";
			
				echo mysql_error()."<br>\n";
			}
		}
	
		function QUERY( $string )
		{
			$this->m_queryResult = mysql_query( $string );

			if( mysql_error() )
				$this->ERROR( $string );

			return $this->m_queryResult;
		}
	
		function RESULT( $string )
		{
			$this->QUERY( $string );

			if( $this->m_queryResult )
				return mysql_fetch_array( $this->m_queryResult );

			return false;
		}
		
		function DISCONNECT()
		{
			$result = mysql_close();
			if( $result ) {
				$this->m_bConnect = false;
			}

			return false;
		}
	}
	
?>
