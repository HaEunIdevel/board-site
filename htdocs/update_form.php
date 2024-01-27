<?php
    require_once __DIR__ . '/_inc/config.php';
    
    
    $seq = !empty($_GET['seq']) ? $_GET['seq'] : '';
    $table = !empty($_GET['table']) ? $_GET['table'] :'';
    $page = !empty($page['page']) ? $page['page'] : 1;
    $query = "
        SELECT * FROM $table
        WHERE SEQ = $seq
    ";
    $result = $_mysqli->query($query);
    
    if(!$result){
        echo '조회해오지 못하였습니다';
    }
    
    $row = $result->fetch_assoc();
    $name = $row['CREATED_BY'];
    $title = $row['SUBJECT'];
    $contents = $row['CONTENT'];
    $file_nm = $row['FILE_NM'];
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>자유게시판</title>
    <link rel="stylesheet" href="style.css">
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
            location.href='index.php?type=list&table=<?=$table?>&page=<?=$page?>';
        }
    </script>
</head>
<body>
<h2>자유게시판 > 수정하기</h2>
<form action="update.php?seq=<?=$seq?>&table=<?=$table?>&type=update" method="post" name="board" enctype="multipart/form-data">
    <ul class="board_form">
        <li style="display: flex;align-items: center;gap:3px">
            <span class="col1">이름 : </span>
            <span class="col2">
                <p><?=$name?></p>
            </span>
        </li>
        <li>
            <span class="col1">제목 : </span>
            <span class="col2">
                <input type="text" name="title" value="<?=$title?>"/>
            </span>
        </li>
        <li class="area">
            <span class="col1">내용 : </span>
            <span class="col2">
                <textarea name="contents" id="" cols="30" rows="10"><?=$contents?></textarea>
            </span>
        </li>
        <li class="area">
            <span class="col1">첨부파일 : </span>
            <span class="col2">
                <input type="file" name="upfiles"/><?=$file_nm?>
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


