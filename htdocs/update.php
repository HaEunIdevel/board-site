<?php
    require_once __DIR__ . '/_inc/config.php';
    
    
    $seq = !empty($_GET['seq']) ? $_GET['seq'] : '';
    $title = !empty($_POST['title']) ? $_POST['title'] : '';
    $contents = !empty($_POST['contents']) ? $_POST['contents'] : '';
    $title = htmlspecialchars($title,ENT_QUOTES); // ENT_QUOTES:  ''(홑따옴표) 와 ""(겹따옴표) 둘다 변환
    $contents = htmlspecialchars($contents,ENT_QUOTES);
    $table = !empty($_GET["table"]) ?$_GET["table"] : '';
    $page = !empty($_GET["page"]) ? $_GET["page"] : 1;
    
    $file_dir = '/data/';
    $upload_dir = __DIR__ . $file_dir;
    
    if (!is_dir($upload_dir)) {
        $makeDir = mkdir($upload_dir, 0777, true);
    }
    $file_name = $_FILES['upfiles']['name']; // 업로드하는 파일명
    $temp_name = $_FILES['upfiles']['tmp_name']; // 실제 서버에 저장되는 임시 파일명
    $file_type = $_FILES['upfiles']['type']; //업로드 파일 타입
    $file_size = $_FILES['upfiles']['size']; // 업로드 파일 크기
    $file_error = $_FILES['upfiles']['error']; // 발생오류
    $copied_file_name = "";
    $uploads_file_path = "";
    
    
    if($file_name && !$file_error){
        
        $file = explode(".",$file_name); // 파일명.확장자 => '.'을 기준으로 쪼갬
        $upload_file_name = $file[0]; // 파일 이름
        $file_ext = $file[1]; // 파일 확장자
        
        $copied_file_name = date('Y-m-d_Hsi').".".$file_ext;
        $uploads_file_path = $upload_dir.$copied_file_name;
        
        
        $file_path = $file_dir.$copied_file_name;
        if($file_size >  20 * 1024 * 1024){
            echo "
            <script>
                alert('업로드 파일크기가 지정된 용량(20MB)를 초과합니다.<br>파일 크기를 체크해주세요.');
               history.go(-1);
            </script>
            ";
            exit;
        }
        if(!move_uploaded_file($temp_name,$uploads_file_path)){
            $last_error = error_get_last();
            echo "
        <script>
        alert('파일을 지정한 디렉토리에 복사하는데 실패하였습니다. Error: {$last_error['message']}');
        history.go(-1);
        </script>
    ";
            exit;
        }
        
    }else{
        $file_name = "";
        $file_type = "";
        $copied_file_name = "";
    }
    
    $query = "
        UPDATE $table
        SET
        SUBJECT = '{$title}',
        CONTENT = '{$contents}',
        FILE_NM ='{$file_name}',
        FILE_TYPE = '{$file_type}',
        COPIED = '{$copied_file_name}',
        FILE_FULL_PATH = '{$file_path}',
        UPDATED_AT = NOW()
        WHERE SEQ = $seq
    ";
  $result =  $_mysqli->query($query);
    if(!$result){
        echo '수정중 오류가 발생하였습니다';
    }else{
    echo <<<END
<script>
alert('수정완료');
location.href = 'index.php?type=list&table={$table}'
</script>

END;

    }
    



?>

