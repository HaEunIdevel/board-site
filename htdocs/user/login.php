<?php
    require_once __DIR__ . '/../_inc/config.php';
    
    $memId = (!empty($_POST['memId'])) ? $_POST['memId'] : '';
    $pw = (!empty($_POST['pw'])) ? ($_POST['pw']) : '';
    
    
    $query = "
        SELECT *
        FROM MEMBERS
        WHERE
        MEM_ID = '{$memId}'
    ";
    
$result = $_mysqli->query($query);
$num_match = $result->num_rows;
p($num_match);
if(!$num_match){
    echo <<<END
<script>
alert('등록되지 않은 아이디입니다')
</script>
END;
}else{
    $row = $result->fetch_assoc();
    if(Decrypt($row['MEM_PW']) !== $pw){
        echo <<<END
<script>
alert('비밀번호가 틀렸습니다 다시 입력해 주세요')
</script>
END;
    
    }else{
        $_SESSION['memId'] = $row['MEM_ID'];
        $_SESSION['name'] = $row['MEM_NAME'];
        $_SESSION['level'] = $row['MEM_LEVEL'];
        echo <<<END
<script>
alert('로그인되었습니다.')
location.href = '../index.php?type=list&table=notice'
</script>
END;
    }
}

