<?php
$mode = !empty($_GET['mode']) ? $_GET['mode'] : '';
$seq = !empty($_GET['seq']) ? $_GET['seq'] : '';


if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>비밀번호 입력하기</title>
</head>
<body>
<h3>비밀번호를 입력해주세요</h3>
<?php
if($error === 'Y'){
    echo '<p>비밀번호가 틀립니다 다시 입력해주세요</p>';
}
?>
<form action="password.php?mode=<?=$mode?>&seq=<?=$seq?>" method="post">
  비밀번호:  <input type="password" name="password"/>
    <button>확인</button>
</form>
</body>
</html>
