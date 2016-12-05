<? @session_start() ?>
<?
    $name=$_SESSION['name'];
    ?>
<html>
<meta charset='utf-8' />
<head> 
 <style type="text/css">
 A:link { color:#000000;} 
 A:visited { color:#000000;} 
 A:active { color:#000000;} 
 A:hover { color:#000000;} 
 </style>
<script type="text/javascript">
 function before(before) {
    document.f1.method = "post" ;
    document.getElementById("hidden_p").value = parseInt(before);
    document.f1.action = "list.php";
    document.f1.submit();
  }
  function after(after) {
    document.f1.method = "post" ;
    document.getElementById("hidden_p").value = parseInt(after);
    document.f1.action = "list.php";
    document.f1.submit();
  }
  function show_detail(id) {
    document.f1.method = "post" ;
    document.getElementById("num_id").value = parseInt(id);
    document.f1.action = "show.php";
    document.f1.submit();
  }
</script>
</head>
<?echo($name);?> 님
<form action="shoppinglist.html">
<input type="submit" value="선택화면으로">
</form>
<form action="second.php">
<input type="submit" value="초기화면으로">
</form>
<?
$p_id=$_POST['p_id'];
$person=$_POST['person'];
include("head.inc");
$pagenum=$_POST['pagenum'];

if (is_null($pagenum)) $pagenum=1;

include("head.inc");
$item_per_page=10;         // 페이지당 목록 수

$first_item=($pagenum-1)*$item_per_page;   //보여주는 쇼핑몰의 첫 item
 $last_item=$first_item+($item_per_page-1);                //보여주는 쇼핑몰의 마지막 item
 if ($total<=$last_item) {
    $last_item=$total;
 }

$max=$p_id+10000;
$query="select * from item where p_id>=$p_id and p_id<$max limit $first_item,$item_per_page";
mysql_query("set names utf8");
$result=mysql_query($query,$dbconn); 

$query1="select * from item where p_id>=$p_id and p_id<$max"; 
$result1=mysql_query($query1,$dbconn); 
$count=mysql_num_rows($result1);
?>

<form name="f1">
  <input type="hidden" id="hidden_p" name="pagenum" value="<? echo($pagenum); ?>">
  <input type="hidden" id="num_id" name="p_id" value="<? echo($p_id); ?>">
  <input type="hidden"   name="person" value="<? echo($person); ?>">
</form>

<?
$i=1;

echo("<table width=600 height=* align=center border=0>");
$pic_per_line=4;
while ( $a=mysql_fetch_array($result)) {            // 페이지별 목록 보여주기
    $pic=$a["pic"];
    $name=$a["name"];
    $price=$a["price"];
    $show_price=number_format($price);
    $p_id=$a["p_id"];

    if($i%$pic_per_line!=0){
      echo("<td>");    
    }
    else{  
      echo("<tr><td>");
      $i=1;
    }
    echo("<table border=0  height=300 weith=200><td align=center>");       // 그림
    echo("<a href='javascript:show_detail($p_id);'><img src='$pic'></a>");
    echo("<tr><td align=center>$name");           // 상품명 표시
    echo("<tr><td align=center>${show_price}원 ");       // 가격 표시
    echo("</table>");
    $i++;
} 
echo("</table>");

echo("<br><br><center>");   //10개 이상일 경우 보여주기
$total_page=ceil($count/$item_per_page);
$l_list=ceil($pagenum/10)*10;
    $f_list=$l_list-9;
    if ($f_list>10){              //이전 버튼 처리
        $before=$f_list-1;
        echo("<a href='javascript:before($before);'>이전 </a> << ");    
    }    
    
    if ($l_list< $total_page){    
       for ($i=$f_list;$i<=$l_list;$i++) {   // 중간 10개
         if ($pagenum!=$i){
            echo("[<a href='javascript:but($i);'>$i</a>]");
           }
         else
          
           echo("[$i]");
         echo("&nbsp;&nbsp;");
       }
        $after=$l_list+1; 
        echo(">><a href='javascript:after($after);'>다음 </a>");    
    } else { 
       for ($i=$f_list;$i<=$total_page;$i++) {       // 중간에서 끝남
         if ($pagenum!=$i){
           echo("[<a href='javascript:before($i);'>$i</a>]");
           }
         else
           echo("[$i]");
         echo("&nbsp;&nbsp;");
       }
    }   
    echo("</center>");
    echo("<br><br>");



?>