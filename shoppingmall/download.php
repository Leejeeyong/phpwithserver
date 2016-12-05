<? 
$dbconn=mysql_connect("localhost","fghj","fghj0720");
$status=mysql_select_db("member",$dbconn);
if ($status!=1){
   echo("DB연결실패");
   exit;
}
?>
<html>
<head><title>다운받기</title>
<script language="javascript">

function delok()
{
 vn_con = confirm('정말로 삭제하시겠습니까? [확인]을 누르시면, 삭제됩니다.');
 if ( vn_con == true  )
 {
 document.f1.action = "deleteok.php";
 document.f1.submit();
 }
} 
function updateok()
{
 vn_con = confirm('정말로 수정하겠습니까? [확인]을 누르시면, 수정됩니다.');
 if ( vn_con == true  )
 {
 document.f1.action = "update1.php";
 document.f1.submit();
 } 
}

</script>
</head>
<body>

<?
  $pagenum=$_GET['pagenum'];
  $num=$_GET['num'];
  $p_name=$_GET['p_name'];
  $p_id=$_GET['p_id'];
  $search=$_GET['search'];
  $keyword=$_GET['keyword'];
  $query0="update dtroom set ref=ref+1 where id=$num";   //조회숫자 늘리기
  $result0=mysql_query($query0,$dbconn);
  // 번호에 맞는 데이타 다시 가져오기
  $query1="select id,p_name,ref,putdate,subject,comment,p_id from dtroom where id=$num";
  mysql_query("set names utf8");
  $result1=mysql_query($query1,$dbconn);
  $row=mysql_fetch_row($result1);
  
  echo("<form method=post name=f1><input type=hidden name=pagenum value=$pagenum>
  <input type=hidden name=id value=$row[0]>
  <input type=hidden name=p_name value=$row[1]>
  <input type=hidden name=p_id value=$row[6]>
  </form>");  //수정, 삭제 중가용으로 사용
  
  echo("<table width=700 height=40 align=center border=0>");
  $p_name=urlencode($p_name); 

  if ($p_id==$row[6]) {      // 수정 , 삭제 보여주기
     echo("<td width=50><a href='javascript:updateok();'><img src='./pic/update.bmp' border=0></a>");
     echo("<td width=50><a href='javascript:delok();'><img src='./pic/delete.bmp' border=0 ></a>");
   } else {
     echo("<td width=100>");
   }
        echo("<td width=200>");

  echo("<td width=100><a href='datahouse.php?pagenum=1&p_name=$p_name&p_id=$p_id'><img src='./pic/new_list.gif' border=0>최신목록</a>");
  echo("<td width=100><a href='datahouse.php?pagenum=$pagenum&p_name=$p_name&p_id=$p_id'><img src='./pic/list.gif' border=0> 목 록 </a>");
  echo("<td width=100>");
  
  $query2="select min(id) from dtroom where id>$row[0]";       //윗글 보여주기
  $result2=mysql_query($query2,$dbconn);
  $up=mysql_fetch_row($result2);
  if ($up[0]=="") {
       echo("<img src='./pic/up.gif' border=0>윗목록 </a>");  }
  else {
       echo("<a href='download.php?pagenum=$pagenum&num=$up[0]&p_name=$p_name&p_id=$p_id'>
             <img src='./pic/up.gif' border=0>윗목록 </a>");
       }
  
  echo("<td width=100>");
  $query3="select max(id) from dtroom where id<$row[0]";       //아랫글 보여주기
  $result3=mysql_query($query3,$dbconn);
  $below=mysql_fetch_row($result3);
  if ($below[0]=="") {
       echo("<img src='./pic/down.gif' border=0>아랫목록 </a>");  }
  else {
       echo("<a href='download.php?pagenum=$pagenum&num=$below[0]&p_name=$p_name&p_id=$p_id'>
             <img src='./pic/down.gif' border=0>아랫목록 </a>");
       }
   echo("</table>");
   

  echo("<table align=center width=700 border=1>");
  echo("<td colspan=4 width=700 align=center><font size=4 color=red>$row[4]</font>");
  echo("<tr><td width=100 align=center> 번호 : $row[0]<td width=200 align=center>");
  echo("  글쓴이 : $row[1] ");
  echo("<td width=100 align=center>조회 : $row[2] <td width=200 align=center>날짜:$row[3]<tr>"); 
  echo("<td colspan=5 width=700 height=300 valign=top>$row[5]<tr>");

  echo("<br><br>");
  mysql_close($dbconn);
?>
