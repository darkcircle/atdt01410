<?php

	
	define ( MENU_SHOW_CODE, 	 1 );
	define ( MENU_SHOW_NAME, 	 2 );
	define ( MENU_SHOW_URL,	 	 4 );
	define ( MENU_SHOW_TIP,	 	 8 );
	define ( MENU_SHOW_NORMAL, 	11 );

	
	class CMENU
	{
		
		var $m_MenuBuf;

		
		function CMENU() 
		{
			$this->m_MenuBuf["COUNT"] = 0;
		}

		function ADD( $CODE, $NAME, $URL, $TIP="", $GO="1", $CLASS="메뉴", $TAG="", $ARROWINDEX="-1", $SHOWMODE=MENU_SHOW_NORMAL )
		{
			$ITEM = Array( 	"CODE" 		=> $CODE,
							"NAME"		=> $NAME,
							"URL"		=> $URL,
							"TIP"		=> $TIP,
							"GO"		=> $GO,
							"CLASS"		=> $CLASS,
							"TAG"		=> $TAG,
							"ARROWINDEX"=> $ARROWINDEX,
							"SHOWMODE"	=> $SHOWMODE );
		
			$pos = ++$this->m_MenuBuf["COUNT"];
			$this->m_MenuBuf[$pos] = $ITEM;
		}

		function ITEMADD( $ITEM )
		{
			if( ! isset($ITEM["SHOWMODE"]) )  $ITEM["SHOWMODE"] = MENU_SHOW_NORMAL;
			if( ! isset($ITEM["CLASS"]) )	  $ITEM["CLASS"]    = "메뉴";
			if( ! isset($ITEM["GO"]) )	 	  $ITEM["GO"]     	= "1";
			if( ! isset($ITEM["ARROWINDEX"])) $ITEM["ARROWINDEX"] = "-1";

			$pos = ++$this->m_MenuBuf["COUNT"];
			$this->m_MenuBuf[$pos] = $ITEM;
		}
		
		function EDIT( $CODE, $PROPERTY, $VALUE )
		{
			$ITEM = $this->GET_ITEM( $CODE );
		
			if( $ITEM != NULL ) {
				$ITEM[$PROPERTY] = $VALUE;

				$this->SAVE( $CODE, $ITEM );		
			}
		}
	
		function SAVE( $CODE, $ITEM )
		{
			$last = $this->m_MenuBuf["COUNT"];
			
			for( $pos = 1; $pos <= $last; $pos++ ) {
				
				$temp = $this->m_MenuBuf[$pos];
				
				if( $temp["CODE"] == $CODE ) 
					$this->m_MenuBuf[$pos] = $ITEM;
			}
		}
		
		function DELETE( $CODE )
		{
			$last = $this->m_MenuBuf["COUNT"];
			
			for( $pos = 1; $pos <= $last; $pos++ ) {
				
				$ITEM = $this->m_MenuBuf[$pos];
				
				if( $ITEM["CODE"] == $CODE ) 
					$this->m_MenuBuf[$pos] = NULL;
			}
		}
	
		function GET_ITEM( $CODE )
		{
			$last = $this->m_MenuBuf["COUNT"];
			
			for( $pos = 1; $pos <= $last; $pos++ ) {
				
				$ITEM = $this->m_MenuBuf[$pos];
				
				if( $ITEM["CODE"] == $CODE ) 
					return $this->m_MenuBuf[$pos];
			}
		}

		function GET_COUNT()
		{
			$last  = $this->m_MenuBuf["COUNT"];
			$total = 0;
			
			for( $pos = 1; $pos <= $last; $pos++ ) {
				
				if( $this->m_MenuBuf[$pos] != NULL ) 
					$total++;
				
			}

			return $total;
		}
	
		function GET_SLOT_COUNT()
		{
			return $this->m_MenuBuf["COUNT"];
		}
	
	}

?>
