<?
include("head.inc");


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
    echo("<script>alert('�̹� �����ϴ� ID�Դϴ�. �ٸ� ID�� ����ϼ���.'); location='reg.php'; </script>");
   }
   else {  
    echo("<script>alert('��밡���� ID�Դϴ�.'); location='reg.php'; </script>");
   } 
?>
</form></center></body></html>
