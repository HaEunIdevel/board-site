<?php

    $type = !empty($_GET["type"]) ? $_GET["type"] : 'list';
    
    require_once __DIR__."/include/board_setup.php";
    require_once __DIR__."/include/header.php";
    require_once $type.".php";
?>