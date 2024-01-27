<?php
    require_once __DIR__ . '/../_inc/config.php';
    
    
    
    $memId = (!empty($_POST['memId'])) ? $_POST['memId'] : '';
    $pw = (!empty($_POST['pw'])) ? Encrypt($_POST['pw']) : '';
    $name = (!empty($_POST['name'])) ? $_POST['name'] : '';
    $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
    
    $query = "
        INSERT INTO MEMBERS
        (MEM_NAME,MEM_ID,MEM_EMAIL,MEM_PW)
        VALUES
        ('{$name}','{$memId}','{$email}','{$pw}')
    ";
    echo($query);
    $_mysqli->query($query);
    mysqli_close($_mysqli);
    
    echo <<<END
    <script>
    location.href = 'login_form.html';
    </script>
END;

