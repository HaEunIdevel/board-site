<?php
require_once __DIR__ . '/../include/header.php'
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>자유게시판 > 회원가입</title>
    
    <script>
        // 저장하기 전 각 입력값을 체크
        function check_input(){
            if(!document.members.memId.value){
                alert('아이디를 입력해주세요');
                document.members.memId.focus();
                return;
            }
            if(!document.members.pw.value){
                alert('비밀번호를 입력해주세요');
                document.members.pw.focus();
                return;
            }
            if(document.members.pw.value !==document.members.pw_check.value){
                alert('비밀번호를 확인해주세요');
                document.members.pw.focus();
                document.members.pw.select();
                return;
            }
            if(!document.members.memId.value){
                alert('아이디를 입력해주세요');
                document.members.memId.focus();
                return;
            }
            if(!document.members.name.value){
                alert('이름을 입력해주세요');
                document.members.name.focus();
                return;
            }
            if(!document.members.email.value){
                alert('이메일을 입력해주세요');
                document.members.email.focus();
                return;
            }
            document.members.submit();
        }


        // 아이디 중복확인
        function check_id(){
            window.open('check_id.php?memId='+document.members.memId.value,"memId_check","height=400,width=500,left=700,top=300")
        }

    </script>
</head>
<body>
<form action="insert_user.php" method="post" name="members">
    <div >
       <span>아이디</span><input type="text" name="memId" placeholder="아이디를 입력하세요"/>
        <button   type="button" onclick="check_id()">중복체크</button>
    </div><br>
    <span >비밀번호</span><input type="password" name="pw" placeholder="비밀번호를 입력하세요"/><br>
    <span >비밀번호</span><input type="password" name="pw_check" placeholder="비밀번호를 확인해주세요"/><br>
    <span >이름</span><input type="text" name="name" placeholder="이름을 입력하세요"/><br>
    <span>이메일</span><input type="text" name="email" placeholder="이메일을 입력하세요"/><br>
    <div><button onclick="check_input()">저장하기</button><button type="button">나가기</button></div>
</form>
</body>
</html>