<?
// DB에있는  inoboard 테이블을 지움 

$SETUP["USING_DB"] = true;
include "../../default.php";

$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

echo "
<A Href=./>메인으로</A>
<Hr>
";
$query = "drop table ".$boardid;
$result = mysql_query($query);
echo mysql_error();

echo "
<Hr>
End
";
?>
