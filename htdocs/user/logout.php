<?php
    require_once __DIR__ . '/../_inc/config.php';

    unset($_SESSION['memId']);
    unset($_SESSION['name']);
    $type = !empty($_GET["type"]) ? $_GET["type"] : 'list';
    $table = !empty($_GET["table"]) ? $_GET["table"] : '';
    $page = !empty($_GET["page"]) ? $_GET["page"] : 1;
    
    echo <<<END
        <script>
        alert('로그아웃되었습니다');
        location.href = '../index.php?type={$type}&table=notice&page={$page}'
        </script>
END;
