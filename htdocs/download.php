<?php
    require_once __DIR__ . '/_inc/config.php';
    
    $file_src = !empty($_GET['file_path']) ? __DIR__. $_GET['file_path'] : '';
    $file_nm = !empty($_GET['file_nm']) ? $_GET['file_nm'] : '';
    
    if (file_exists($file_src)) {
        // 이미지인 경우 Content-Type을 image/jpeg로 설정
        header("Content-Type: image/*");
        // 다운로드 시 파일 이름을 지정합니다.
        header('Content-Disposition: attachment; filename=' . $file_nm);
        readfile($file_src);
    }
?>
