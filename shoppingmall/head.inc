<?
//db 연결
$dbconn=mysql_connect("localhost","fghj","fghj0720");

//사용할 db 선택
$status=mysql_select_db("member",$dbconn);
if ($status==0) {
   $errNO=mysql_errno($dbconn);
   $errMSG=mysql_error($dbconn);
   echo("서버와의 연결이 실패되었습니다<br>");
   echo("에러코드${errNO}  :  ${errMSG}");
   exit;
}

?>

