<?php
    require_once __DIR__ . '/../_inc/config.php';
    $table = !empty($_GET["table"]) ? $_GET["table"] : '';
    $page = !empty($_GET["page"]) ? $_GET["page"] : 1;
    
    if (!empty($_SESSION['memId']))
        $userid = $_SESSION['memId'];
    else {
        $userid = "";
    }
    
    if (!empty($_SESSION['name']))
        $username = $_SESSION['name'];
    else 
        $username = "";
    
    if (!empty($_SESSION["level"]))
        $userlevel = $_SESSION["level"];
    else 
        $userlevel = "";
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>WebSite</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h3 class="logo">
        <a href="../main/index.php">WebSite</a>
    </h3>
    <ul class="top_menu">
<?php
    if(!$userid) {
        echo "<li>방문을 환영합니다 </li>";
    }
    else {
        $logged = $username."(Level:".$userlevel.")님 환영합니다. ";
        echo "<li>$logged</li>";
    }
?>
    </ul> <!-- top_menu -->

    <ul class="main_menu">
<?php
    if(!$userid) {
?>
        <li><a href="../user/user_add_input.html">회원 가입</a> </li>
        <li><a href="../user/login_form.html">로그인</a></li>
<?php
    } else {
?>
        <li><a href="../user/logout.php?type=<?=$type?>&table=<?=$table?>&page=<?=$page?>">로그아웃</a> </li>
        <li><a href="../user/user_info_form.php">정보 수정</a></li>
<?php
    }
?>
    <li>|</li>
    <li><a href="../index.php?type=list&table=notice">공지사항</a></li>
   
    </ul> <!-- main_menu -->
</header>