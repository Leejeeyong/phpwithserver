<?
session_start();
$name=$_SESSION['name'];
?>
<html>
 <body>
 <?echo($name);?>님 환영합니다.
 <br>
 <form action=board.php>
  <input type=submit value="게시판">
 </form>
 <br>
 <form action=logout.php>
  <input type=submit value="로그아웃">
 </form>
 </body>
</html>