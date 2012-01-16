<?
$SETUP["USING_DB"] = true;
include "../../default.php";

$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

$query = "drop table $tablename";

$result = mysql_query($query);

if( mysql_error() ) {
	echo "Error:".mysql_error();
} else {
	echo "<A Href=index.php>목록으로</A><Hr>";
	echo "Ok.";
}
?>
