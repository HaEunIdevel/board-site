<?php
    require_once __DIR__ . '/../_inc/config.php';
    
    
    if(!empty($_SESSION['memId'])){
        $memId = $_SESSION['memId'];
    }else{
        $memId = '';
    }

    $query = "
        SELECT * FROM MEMBERS
        WHERE MEM_ID = '{$memId}'
    ";
$result = $_mysqli->query($query);
    
  $data = $result->fetch_assoc();
  $name = $data['MEM_NAME'];
  $id = $data['MEM_ID'];
  $pw = Decrypt($data['MEM_PW']);
  $email = $data['MEM_EMAIL'];
  $memSeq = $data['MEMBER_SEQ'];
  
?>


<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        function check_input(){
            if(!document.members.id.value){
                alert('아이디를 입력해주세요');
                document.members.id.focus();
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

    </script>
</head>
<body>
<form action="user_update.php?memId=<?=$memId?>" method="post" name="members">
    <div><p>아이디</p><input type="text" name="id" value="<?=$id?>"/></div>
    <div><p>비밀번호</p><input type="password" name="pw" value="<?=$pw?>"/></div>
    <div><p>비밀번호 확인</p><input type="password" name="pw_check" /></div>
    <div><p>이름</p><input type="text" name="name" value="<?=$name?>"/></div>
    <div><p>이메일</p><input type="text" name="email" value="<?=$email?>"/></div>
    <button>저장</button>
</form>
</body>
</html>