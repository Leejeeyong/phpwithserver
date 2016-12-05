
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>회원 가입</title>
<script language="javascript">
</script>
</head>
<body>
<form name=Member method=post action="reg1.php">
ID<input type=text name=p_id size=12 maxlength=12>
	<input type=hidden name=check_id value=0> &nbsp;&nbsp;
  <input type="button" name="checkID" value="ID중복확인"
          onclick="return checkPID();">
  <br>        
  이름<input type=text name=p_name size=12> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <font face=?뗭? size=2>(실명으로 쓰십쇼.)</font>
  <br>
  비밀번호<input type=password name=pwd1 size=8 >
  비번확인<input type=password name=pwd2 size=8 >
  <input type=submit value="회원입력">&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset value="다시쓰기">
</form>
</body>
</html>