<html>
<meta charset='utf-8' />
<head> 
 <style type="text/css">
 A:link { color:#000000;} 
 A:visited { color:#000000;} 
 A:active { color:#000000;} 
 A:hover { color:#000000;} 
 </style>



 </head>
<?
/*  session_start();
 if (!session_is_registered('member_sid')) {
        echo("<script>
        window.alert('회원만 들어올 수 있습니다.');
        location=\"index.html\";
        </script>");
        exit;
   }  
*/

$pagenum=$_GET['pagenum'];
$keyword=$_POST['keyword'];
if (is_null($pagenum)) $pagenum=1;

$dbconn=mysql_connect("localhost","fghj","fghj0720");
$status=mysql_select_db("member",$dbconn);
if ($status!=1){
   echo("DB연결실패");
   exit;
}
$item_per_page=10;         // 페이지당 목록 수

if ($keyword=='') { 
  $str="select count(id) from dtroom";    //총 갯수 찾기
}
else {
  $search=$_POST['search'];
  $keyword=$_POST['keyword'];
  $str="select count(id) from dtroom where $search like '%$keyword%'";    //총 갯수 찾기
}
  mysql_query("set names utf8");
  $qur=mysql_query($str,$dbconn);
  $tot=mysql_fetch_row($qur);
  $total=$tot[0];
  $total_page=ceil($total/$item_per_page);                  // 전체 페이지 수
   
 $first_item=($pagenum-1)*$item_per_page;   //보여주는 자료실의 첫 item
 $last_item=$first_item+($item_per_page-1);                //보여주는 자료실의 마지막 item
 if ($total<=$last_item) {
    $last_item=$total;
 }
 
 if ($keyword=='') {        // 검색조건이 없을 경우
    $query="select * from dtroom order by id desc limit $first_item,$item_per_page "; }
 else {   // 제목, 이름, 내용으로 검색할 경우
    $pagenum=$_POST['pagenum'];
	$p_name=$_POST['p_name'];
	$p_id=$_POST['p_id'];
	$search=$_POST['search'];
    $query="select * from dtroom where $search like '%$keyword%' order by id desc limit $first_item,$item_per_page";
	$keyword=urlencode($keyword);
 }
 mysql_query("set names utf8");
 $result=mysql_query($query,$dbconn);                      // 쿼리 실행

 if ($pagenum>1) {          //이전버튼을 위하여
   $prev=$pagenum-1; }
 
 if ($pagenum < $total_page){    //다음 버튼을 위하여
   $next=$pagenum+1;  }
 
 
 
?>
<center><font size=6 color=red>게시판</font></center><br> 
<table width=800 height=40 align=center border=0>
<? $p_name=urlencode($p_name); ?>
<td width=200 align=left><a href='write1.php?p_name=<? echo($p_name) ?>&p_id=<? echo($p_id) ?>'><img src='./pic/upload.bmp' border=0></a>
<td width=400> 전체글 <? echo($total) ?>

<td width=100>
<a href='datahouse.php?pagenum=1&p_name=<? echo($p_name) ?>&p_id=<? echo($p_id)?>'><img src='./pic/new_list.gif' border=0>최신목록</a>

<td width=100>
<? if ($pagenum!=1) {?>
<a href='datahouse.php?pagenum=<? echo($prev) ?>&search=<? echo($search) ?>&keyword=<? echo($keyword) ?>&p_name=<? echo($p_name) ?>&p_id=<? echo($p_id)?>'>
<img src='./pic/up.gif' border=0>윗목록 </a>
<? } else { ?>
<img src='./pic/up.gif' border=0>윗목록 
<? } ?>
<td width=100>
<? if ($pagenum != $total_page) { ?>
<a href='datahouse.php?pagenum=<? echo($next) ?>&search=<? echo($search) ?>&keyword=<? echo($keyword)?>&p_name=<? echo($p_name) ?>&p_id=<? echo($p_id) ?>'>
<img src='./pic/down.gif' border=0>아랫목록</a>
<? } else { ?>
<img src='./pic/down.gif' border=0>아랫목록
<? } ?>
</table>

<? //게시판 보여주기 ?>
<table width=800 align=center border=1>
<th width=50>번호<th width=500>제목<th width=80>글쓴이<th width=50>조회<th width=150>날짜
<?
 while ( $a=mysql_fetch_array($result)) {            // 페이지별 목록 보여주기
    $id=$a[id];
    $subject=$a[subject];
    $name=$a["p_name"];
    $down=$a["down"];
    $ref=$a["ref"];
    $putdate=$a["putdate"];
   
    echo("<tr><td align=center>$id");        // 번호표시
    echo("<td align=left>&nbsp;&nbsp;&nbsp;<a href='download.php?pagenum=$pagenum&num=$id&p_id=$p_id&p_name=$p_name&search=$search&keyword=$keyword'>$subject</a>");  // 제목표시
    echo("<td align=center>$name");          // 이름 표시
    echo("<td align=center>$ref");           // 조회표시
    echo("<td align=center>$putdate");       // 날짜표시
 } 
   echo("</table>");
   // 페이지 리스트
    echo("<br><br><center>");
    $l_list=ceil($pagenum/10)*10;
    $f_list=$l_list-9;
    if ($f_list>10){              //이전 버튼 처리
        $before=$f_list-1;
        echo("<a href='datahouse.php?pagenum=$before&search=$search&keyword=$keyword&p_id=$p_id&p_name=$p_name'>이전 </a> << ");    
    }    
    
    if ($l_list< $total_page){    
       for ($i=$f_list;$i<=$l_list;$i++) {   // 중간 10개
         if ($pagenum!=$i)
           echo("[<a href='datahouse.php?pagenum=$i&search=$search&keyword=$keyword&p_id=$p_id&p_name=$p_name'>$i</a>]");
         else
           echo("[$i]");
         echo("&nbsp;&nbsp;");
       }
        $after=$l_list+1;                    // 다음버튼 처리
        echo(">><a href='datahouse.php?pagenum=$after&search=$search&keyword=$keyword&p_id=$p_id&p_name=$p_name'>다음 </a>");    
    } else { 
       for ($i=$f_list;$i<=$total_page;$i++) {       // 중간에서 끝남
         if ($pagenum!=$i)
           echo("[<a href='datahouse.php?pagenum=$i&search=$search&keyword=$keyword&p_id=$p_id&p_name=$p_name'>$i</a>]");
         else
           echo("[$i]");
         echo("&nbsp;&nbsp;");
       }
    }   
    echo("</center>");
    echo("<br><br>");

    // 검색부분
    echo("<center>");
    $p_name1=urldecode($p_name);
    echo("
          <form action='datahouse.php' method=post>
          <table border=0 width=580><tr>
          <td align=center>
          <input type=hidden name=pagenum value=1>
          <input type=hidden name=p_name value=$p_name1>
          <input type=hidden name=p_id value=$p_id>
          <select name=search>
            <option value=subject>제목
            <option value=p_name>이름
            <option value=comment>내용
          </select>
          <input type=text name=keyword size=20>
          <input type=submit value=찾기>
          </table></form>"); 
     echo("</center>");
    mysql_close($dbconn);   
?>
</body></html>
