
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf8">
<title>회원 가입</title>
<script language="javascript">
function isEmpty(arg) {
   if (arg.value==""){
      alert("자료를 꼭 입력하십시오");
      return false;
   } else {
      return true;
   }
 }

 function isSkip(arg) {
     for (var i=0;i<arg.value.length;i++) 
      {
        if (arg.value.substring(i,i+1) ==" "){
           alert("입력값에 빈 공간이 있습니다.");          
           return false; }     
      }
      return true;
   }

 function checkid(arg) {
     idchar=new Array(arg.value.length);
     spechar=new Array('/','.','>','<',',','?','{','}','\\');
     for (i=0; i<arg.value.length; i++) {
       for (j=0; j<spechar.length; j++) {
          if (spechar[j]==arg.value.charAt(i)) {
             alert("특수문자는 사용하지 마세요.");             
             return false;
          }}
       idchar[i]=arg.value.charAt(i);
       if ((idchar[i]>=0 && idchar[i]<=9) || (idchar[i]>='a' && idchar[i]<='z')
            || (idchar[i]>='A' && idchar[i]<='Z')) {
          continue; }
       else {
            alert("한글은 입력이 불가입니다.");          
            return false;}
     }
     return true;
   }
function checkPID() {
  if (!isEmpty(Member.p_id) || !isSkip(Member.p_id) || !checkid(Member.p_id)){
     Member.p_id.value="";
     Member.p_id.focus();
     return false;
   }
  else {
    w=open('dup_id.php?p_id='+document.Member.p_id.value,'checkID','width=300,height=200');
  }    
} 
</script>
</head>
<body>
<form name=Member method=post action="reg1.php">
ID&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=p_id size=12 maxlength=12>
	<input type=hidden name=check_id value=0> &nbsp;&nbsp;
  <input type="button" name="checkID" value="ID중복확인"
          onclick="return checkPID();">
  <br>        
  이름<input type=text name=p_name size=12> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <font face=?뗭? size=2>(실명으로 쓰십쇼.)</font>
  <br>
  비밀번호<input type=password name=pwd1 size=8 >
<br>
  비번확인<input type=password name=pwd2 size=8 >
<br>
  <input type=submit value="회원입력">&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset value="다시쓰기">
</form>
</body>
</html>