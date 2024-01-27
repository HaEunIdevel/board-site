<?php
    $table = !empty($_GET["table"]) ? $_GET["table"] : 'notice';
    $scale = 5;	// 글 목록보기에서 한 화면에 표시되는 글 수

    switch($table) {
        case "notice" : $board_title = "공지 게시판";
                break;
        case "youtube" : $board_title = "YOUTUBE 게시판";
                break;
        case "qna": $board_title = "QNA 게시판";
                break;                      
    }
?>