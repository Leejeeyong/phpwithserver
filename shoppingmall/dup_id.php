<?
$dbconn=mysql_connect("localhost","fghj","fghj0720");
$status=mysql_select_db("member",$dbconn);
if ($status!=1){
   echo("DB�������");
   exit;
}


//id �ߺ� üũ�ϱ�
  $p_id=$_POST['p_id'];
  $q_id_check="select * from member where p_id='$p_id'";
  $r_id_check=mysql_query($q_id_check,$dbconn);
  if (!$r_id_check) {
    echo("id ����� ������ �ֽ��ϴ�<br>");
    exit;
  }

  $row_id=mysql_num_rows($r_id_check);
?>
  <? if ($row_id>=1) {
    echo("<script>alert('�̹� �����ϴ� ID�Դϴ�. �ٸ� ID�� ����ϼ���.');</script>");
   }
   else {  
    echo("<script>alert('��밡���� ID�Դϴ�.');</script>");
   } 
?>
