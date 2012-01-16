
function popupopen( pageURL, width, height ) 
{
	
	var strReturn = GetCookie( pageURL );
	
	if( strReturn == null || strReturn == '0' ) {
		popupopenforce( pageURL );
	}
	
}

function popupopenforce( pageURL, width, height ) 
{
	
	window.open( pageURL,"", "width="+width+",height="+height+",toolbar=false,directories=false,status=false,menubar=false,scrollbars=true");
	
}
