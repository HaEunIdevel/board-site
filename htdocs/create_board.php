<?php
    require_once __DIR__ . '/_inc/config.php';

?>
<!Doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$board_title?> > 글쓰기</title>
    <link rel="stylesheet" href="style.css">
    <?php
        
        require_once __DIR__ . '/include/header.php';
    
    ?>
    <script>
        function check_input(){
            if(!document.board.title.value){
                alert('제목을 입력하세요');
                document.board.title.focus();
                return;
            }
            if(!document.board.contents.value){
                alert('내용을 입력하세요');
                document.board.contents.focus();
                return;
            }
            document.board.submit();
        }
        function move_list(){
            location.href='index.php?type=list&table=<?=$table?>';
        }
    </script>
</head>
<body>
<h2><?=$board_title?> > 글쓰기</h2>
<form action="insert_board.php?table=<?=$table?>" method="post" name="board" enctype="multipart/form-data">
    <ul class="board_form">
        <li>
            <span class="col1">제목 : </span>
            <span class="col2">
                <input type="text" name="title"/>
            </span>
        </li>
        <li class="area">
            <span class="col1">내용 : </span>
            <span class="col2">
                <textarea name="contents"  cols="30" rows="10"></textarea>
            </span>
        </li>
        <li class="area">
            <span class="col1">첨부파일 : </span>
            <span class="col2">
                <input type="file" name="upfiles"/>
            </span>
        </li>
    </ul>
    <ul class="buttons">
        <li>
            <button type="button" onclick="check_input()">저장하기</button>
            <button type="button" onclick="move_list()">목록보기</button>
        </li>
    </ul>
</form>
</body>
</html>
