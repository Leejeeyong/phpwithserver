<? @session_start() ?>
<?
    $name=$_SESSION['name'];
    ?>
<html>
<head>
<title>장바구니</title>
<meta charset='utf-8' />
</head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">
<?echo($name);?> 님
<form action="shoppinglist.html">
<input type="submit" value="선택화면으로">
</form>
<form action="second.php">
<input type="submit" value="초기화면으로">
</form>
 <br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font
 size="5" color="fuchsia"><b>장바구니 보기</b></font></p>
<p><font size="1">◆</font> 귀하의 장바구니에는 아래와 같은 상품이 들어있습니다.<br>
<br>
<font size="1">◆&nbsp;</font>수량변경시에는 원하는 수량을 입력한 후, 변경 아이콘을 
클릭하시면 됩니다.</p>
<p>장바구니 내용<br>
<hr width="80%" align="left" noshade>&nbsp;</p>

<?
  $buyer=$_POST['buyer'];
  $p_id=$_POST['p_id'];
  $item_name=$_POST['item_name'];
  $tot_num=$_POST['tot_num'];
  $item_price=$_POST['item_price'];
  $code=$_POST['code'];
  $change=$_POST['change'];


  include("head.inc");
//장바구니에 넣기
  if ($code=="장바구니 담기") {
    $query0="select max(number)+1 from cart";
    $result0=mysql_query($query0,$dbconn);
    $count=mysql_fetch_row($result0);
    if ($count[0]=='') $count[0]=1;

    //한사람이 다른 아이템을 또 구입할 경우
    $query2="select number from cart where cookie='$buyer' and p_id='$p_id'";
    $result2=mysql_query($query2,$dbconn);
    $item_id=mysql_fetch_row($result2);
    $dup=mysql_num_rows($result2);
    if ($dup==0 ) {    //한사람이 아이템을 처음 클릭한 경우
       $putdate=date("Y-m-d:H:i",time());
       $query1="insert into cart values($count[0],'$p_id','$buyer',$tot_num,'$item_name','$putdate',$item_price)";
       mysql_query("set names utf8");
       $result1=mysql_query($query1,$dbconn);
    } else {  //한사람이 같은 아이템을 클릭한 경우
       $query3="update cart set unit=unit+'$tot_num' where number=$item_id[0]"; 
       $result3=mysql_query($query3,$dbconn);
    }
  }
//삭제시
  if ($code=="삭제") {  
     $query4="delete from cart where number=$change";
     $result4=mysql_query($query4,$dbconn);
   }
//수정시
  if ($code=="변경") {
     $query5="update cart set unit='$tot_num' where number=$change";
     $result5=mysql_query($query5,$dbconn);
   }
 
  echo("<table  border=1 width=800>");
  echo("<th width=200>상품명 <th width=200>가격 <th width=80> 수량 <th width=200> 합계 <th>");
  $query2="select name, price, unit, number from cart where cookie='$buyer'";

  mysql_query("set names utf8");
  $result2=mysql_query($query2,$dbconn);
  $sum=0;

  while ($final=mysql_fetch_row($result2)) {
    $total_item=$final[1]*$final[2];
    $sum=$sum+$total_item;
    echo("<form name=f method=post action='shoppingcart.php'>");
    echo("<input type=hidden name=change value=$final[3]>");
    echo("<input type=hidden name=buyer value=$buyer>");
    echo("<tr><td align=center>$final[0]<td align=center>".number_format($final[1])."원<td align=center>");
    echo("<input type=text name=tot_num value=$final[2] size=3><br>");
    echo("<input type=submit name=code value='변경'>");
    echo("<td align=center>".number_format($total_item)."원");
    echo("<td><input type=submit name=code value='삭제'>");
    echo("</form>");
  }
  echo("</table>");
  echo("<br>");
  echo("<center><font size=3 color=red>총합계 :".number_format($sum)."원</font>&nbsp;");
  echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='shoppinglist.html'>홈으로</a></center>");

?>
<p>장바구니 결제<br>
<hr width="80%" align="left" noshade>&nbsp;</p>
<?
 echo("<form method=post action='enterDB.php'>");
 echo("<input type=hidden name=buyer value=$buyer>");
 //더 많은 데이터 DB에 넣기
 echo("<input type=submit name=enter value='결제하기'>");
 echo("</form>");
?> 
 
</body>

</html> 
