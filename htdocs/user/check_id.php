<?php
    require_once __DIR__ . '/../_inc/config.php';

    
    $memId = (!empty($_GET['memId'])) ? $_GET['memId'] : '';
    
    
    // 회원 테이블에서 아이디를 가져와 입력된것과 같은것이 있는지 찾아보자
if(!$memId){
    echo <<<END
        <script>
        alert('아이디를 입력해 주세요!')
        self.close()
        </script>
END;
}else{
    $query = "
        SELECT MEM_ID FROM MEMBERS
        WHERE MEM_ID = '{$memId}'
    ";
    $result = $_mysqli->query($query);
    $num_record = $result->num_rows;
    
    if($num_record){
        echo <<<END
            <script>
            alert('사용할 수 없는 아이디입니다. 다른 아이디를 입력해주세요')
            self.close()
            </script>
END;
    }else{
        echo <<<END
            <script>
            alert('사용가능한 아이디 입니다')
            self.close()
            </script>
END;

    }
    mysqli_close($_mysqli);
}
