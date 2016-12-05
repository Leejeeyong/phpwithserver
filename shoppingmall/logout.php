<?
  @session_start();

  $_SESSION['p_id']="";
  session_unregister("p_id");
  session_unregister("name");
  session_destroy(); 
  echo("<script>alert('로그아웃 되었습니다.'); location='first.php'; </script>");   
  
?> 