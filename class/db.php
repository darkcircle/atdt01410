<?php

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
