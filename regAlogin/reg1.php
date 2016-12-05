<?
$dbconn=mysql_connect("localhost","fghj","fghj0720");
$status=mysql_select_db("member",$dbconn);
if ($status!=1){
   echo("DB연결실패");
   exit;
}
$p_id=$_POST['p_id'];
$pwd=$_POST['pwd1'];
$name=$_POST['p_name'];

mysql_query("set names utf-8");
 $query="insert into member values('$p_id','$pwd','$name',NULL)";
 $result=mysql_query($query,$dbconn);

 if (!result) {
   $errMSG=mysql_error($dbconn);
   echo("입력에 문제가 있습니다<br>");
   echo("에러코드${errNO}  :  ${errMSG}");
   exit;
  }
 else {
   echo("<script>
        window.alert('$name 님 환영합니다. 다시로그인 하세요.');
        location='first.php';
        this.close();
        
        </script>");
  } 

//DB
mysql_close($dbconn);
?>