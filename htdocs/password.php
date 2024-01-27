<?php
    require_once __DIR__ . '/../_inc/config.php';
    
    
    $password = !empty($_POST['password']) ? $_POST['password'] : '';
    $mode = !empty($_GET['mode']) ? $_GET['mode'] : '';
    $seq = !empty($_GET['seq']) ? $_GET['seq'] : '';
    
    // 입력한 비밀번호와 DB에 저장된 해당 게시글 비밀번호 비교하기

$query = "
    SELECT F_PASSWORD FROM FREE_BOARD
    WHERE F_SEQ = $seq
";

$result = $_mysqli->query($query);
$row = $result->fetch_assoc();

$db_password = Decrypt($row['F_PASSWORD']);


if($password === $db_password){
    if($mode === 'update'){
        $url = "update_form.php?seq=$seq";
    }else{
        $url = "delete.php?seq=$seq";
    }
    echo <<<END
<script>
self.close();
opener.location.href = "$url";
</script>
END;

}else{
    // 비밀번호가 틀린경우
    echo <<<END
<script>
location.href = 'password_form.php?seq=$seq&error=Y';
</script>
END;

}