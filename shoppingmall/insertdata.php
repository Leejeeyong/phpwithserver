<?
include("../head.inc");
for($i=1;$i<=360; $i++){
$q2="insert into dtroom (id,sub,p_name,p_id,subject,comment,ref,putdate) 
                values (NULL,0,'홍길동','hongkd1111','꿈 꿨어?','응 구신 꾸꿔셔 ${i}번이나...',0,'2015-09-21')";
 mysql_query("set names utf8");
  $r2=mysql_query($q2,$dbconn);
  }
  
  ?>
