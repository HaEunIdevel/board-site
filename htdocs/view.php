<?php
    require_once __DIR__ . '/_inc/config.php';
    
    // 상세페이지 구현하기
//선택된 레코드 가져오기
  $board_seq = !empty($_GET['num'])  ?  $_GET['num'] : 1;
    $table = !empty($_GET["table"]) ? $_GET["table"] : '';
    $page  = !empty($_GET["page"]);
    
    $query = "
    SELECT * FROM {$table}
    WHERE SEQ = {$board_seq}
  ";
  
  $result = $_mysqli->query($query);
  
  $row = $result->fetch_assoc();

  $seq = $row['SEQ'];
  $name = $row['MEM_NAME'];
  $title = $row['SUBJECT'];
  $contents = $row['CONTENT'];
  $contents = str_replace('','&nbsp;',$contents);// 공백변환
  $contents = str_replace("\n","<br>",$contents);// 줄바꿈변환
  $dates = $row['CREATED_AT'];
$file_src = $row['FILE_FULL_PATH'];
$file_nm = $row['FILE_NM']

  
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$board_title?> 내용</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2><?=$board_title?> > 내용보기</h2>
<ul class="board_view">
    <li class="row1">
        <span class="col1"><b>제목 :</b> <?=$title?></span>
        <span class="col2"> <?=$name?> | <?=$dates?></span>
    </li>
    <li class="row2">
        <?=$contents?>
    </li>
   
        <?php
            if($file_src){
            
            echo <<<END
 <li>
       첨부파일: {$file_nm} <img src="{$file_src}" alt="사진">
       &nbsp;&nbsp;
       <a href="download.php?num={$seq}&file_nm={$file_nm}&file_path={$file_src}">저장</a>
        </li>
END;
            }
            

        ?>
   
</ul>
<ul class="buttons">
    <li><button onclick="location.href='index.php?type=list&table=<?=$table?>&page=<?=$page?>'">목록보기</button></li>
    <li><button onclick="location.href='index.php?type=update_form&table=<?=$table?>&seq=<?=$board_seq?>'">수정하기</button></li>
    <li><button onclick="location.href='index.php?type=delete&table=<?=$table?>&seq=<?=$board_seq?>&page=<?=$page?>'">삭제하기</button></li>
    <li><button onclick="location.href='index.php?type=create_board&table=<?=$table?>'">글쓰기</button></li>
</ul>
</body>
</html>



