<?php
    require_once __DIR__ . '/../_inc/config.php';
    
    $memId = !empty($_GET['memId']) ? $_GET['memId'] : '';
    
    

    
    $id = !empty($_POST['id']) ? $_POST['id'] : '';
    $name = !empty($_POST['name']) ? $_POST['name'] : '';
    $pw = !empty($_POST['pw']) ? Encrypt($_POST['pw']) :  '';
    $email = !empty($_POST['email']) ? $_POST['email'] : '';
    
$update_user_query = "
    UPDATE MEMBERS SET
    MEM_ID = '{$id}',
    MEM_NAME = '{$name}',
    MEM_EMAIL = '{$email}',
    MEM_PW = '{$pw}'
    WHERE MEM_ID = '{$memId}'
";
$update_result = $my->query($update_user_query);

if(!$update_result){
echo '업데이트 실패';

}else{
    echo '회원정보 수정 성공';
}
