<?php
    require_once __DIR__ . '/_inc/config.php';
    echo 123;
    $seq = !empty($_GET['seq']) ? $_GET['seq'] : '';
    $table = $_GET["table"];
    $page  = !empty($_GET["page"]) ? $_GET["page"] : 1 ;

    $query = "
        UPDATE $table
        SET
        USE_YN = 'N'
        WHERE SEQ = $seq
    ";
    $result = $_mysqli->query($query);
    if(!$result){
        echo '삭제시 오류가 발생하였습니다.다시 시도해주세요';
    }else{
        echo <<<END
        <script>
        alert('삭제완료');
        location.href = 'index.php?type=list&table=$table&page=$page'
        </script>
END;
    }