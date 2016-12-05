<?
$dbconn=mysql_connect("localhost","fghj","fghj0720");
$status=mysql_select_db("member",$dbconn);
if ($status!=1){
   echo("DB연결실패");
   exit;
}


//id 중복 체크하기
  $p_id=$_POST['p_id'];
  $q_id_check="select * from member where p_id='$p_id'";
  $r_id_check=mysql_query($q_id_check,$dbconn);
  if (!$r_id_check) {
    echo("id 결과에 문제가 있습니다<br>");
    exit;
  }

  $row_id=mysql_num_rows($r_id_check);
?>
  <? if ($row_id>=1) {
    echo("<script>alert('이미 존재하는 ID입니다. 다른 ID를 사용하세요.');</script>");
   }
   else {  
    echo("<script>alert('사용가능한 ID입니다.');</script>");
   } 
?>
