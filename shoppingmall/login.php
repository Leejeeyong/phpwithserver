<?

$dbconn=mysql_connect("localhost","fghj","fghj0720");
$status=mysql_select_db("member",$dbconn);
if ($status!=1){
   echo("DB연결실패");
   exit;
}
$p_id=$_POST['p_id'];
$pwd=$_POST['pwd'];  

  mysql_query("set names utf8");
  $str="select name from member where p_id='$p_id' and pwd='$pwd'";

  $r_id_check=mysql_query($str,$dbconn);
  
  $row_id=mysql_num_rows($r_id_check);

 if ($row_id>=1) {
 //setcookie("p_id",$p_id,0);
    @session_start();
    $_SESSION['p_id']=$p_id;

    $name=mysql_fetch_row($r_id_check);
    $_SESSION['name']=$name[0];
   
    echo("<meta http-equiv='refresh' content='0;url=second.php'>");
    }
   else {
     echo("<script>
           alert('아이디 또는비밀번호가 틀렸습니다.');
           location='./first.php';
        </script>");
   }
      session.invalidate(); 
?>