<? @session_start() ?>
<?
    $name=$_SESSION['name'];
    ?>
<html>
<meta charset='utf-8' />
<head></head>
<body>
<?echo($name);?> 님
<form action="shoppinglist.html">
<input type="submit" value="선택화면으로">
</form>
<form action="second.php">
<input type="submit" value="초기화면으로">
</form>
<?

  include("head.inc");
  $p_id=$_POST['p_id'];
  $person=$_POST['person'];
  $query="select * from item where p_id=$p_id";
  mysql_query("set names utf8");
  $result=mysql_query($query,$dbconn);
  echo("<table align=center border=1  height=300>");
  $item=mysql_fetch_row($result);
  echo("<form name=f method=POST action='shoppingcart.php'>"); 
  echo("<td rowspan=4 width=300 height=300 align=center><img src='$item[5]'>
          <br><font size=2 color=red align=bottom> $item[0]</font>");
  echo("<td width=100 align=center>판매가 <td width=200 align=center>".number_format($item[2])."원<tr>");
  echo("<td width=100 align=center>제조사 <td width=200 align=center>$item[3]<tr>");
  echo("<td width=100 align=center>상품명<td width=200 align=center>$item[1]<tr>");
  echo("<td width=100 align=center>수량   <td width=200 align=center><input type=text name=tot_num value=1 size=5>개");
  echo("<tr><td colspan=3 width=300 height=50 align=center>$item[4]");
  echo("</table>");
 
  echo("<br><br><br>");

  for ($i=0;$i<=120;$i++){ echo("&nbsp;"); }
 
  echo("<input type=hidden name=p_id value=$item[0]>"); 
  echo("<input type=hidden name=item_name value=$item[1]>"); 
  echo("<input type=hidden name=item_price value=$item[2]>");   
  echo("<input type=hidden name=buyer value=$person>"); 
  echo("<input type=submit name=code value='장바구니 담기'>");

?>

</body></html>
