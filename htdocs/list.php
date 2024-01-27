<?php
    require_once __DIR__ . '/_inc/config.php';
    $table = !empty($_GET["table"]) ? $_GET["table"] : 'notice';
    $type = !empty($_GET["type"]) ? $_GET["type"] : 'list';

?>

<ul class="board_list">
	<h2><?=$board_title?> > 목록보기</h2>
	<li>
		<span class="col1">번호</span>
		<span class="col2">제목</span>
		<span class="col3">글쓴이</span>
		<span class="col4">첨부</span>
		<span class="col5">등록일</span>
	</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;
    
    
    
    $sql = "SELECT * FROM $table WHERE USE_YN = 'Y' ORDER BY SEQ DESC ";	// 일련번호 내림차순 검색
    $result = $_mysqli->query($sql);			// SQL 명령 실행

	$total_record = $result->num_rows; // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = (intval($page) - 1) * $scale;      

	$number = $total_record - $start;
   	for ($i=$start; $i<$start+$scale && $i < $total_record; $i++) {
      	mysqli_data_seek($result, $i); 		// 가져올 레코드로 위치(포인터) 이동      	
      	$row = mysqli_fetch_assoc($result); // 하나의 레코드 가져오기

	  	$num         = $row["SEQ"];			// 일련번호
		$id        	 = $row["MEM_ID"];			// 아이디
	  	$name        = !empty($row["MEM_NAME"]) ? $row["MEM_NAME"] : '비회원';		// 이름
	  	$subject     = $row["SUBJECT"];		// 제목
      	$regist_day  = $row["CREATED_AT"]; 	// 작성일
        $file_nm  = $row["FILE_NM"];	// 첨부 파일
        $file_copied  = $row["COPIED"];	// 저장된 파일
        $file_path  = $row["FILE_FULL_PATH"];	// 저장된 파일

		if ($file_nm) {
				$file_image = "<a href='download.php?num={$num}&file_nm={$file_nm}&file_path={$file_path}'><img src='/img/file.png'></a>";
		}
      	else
      		$file_image = " ";		  
?>
	<li>
		<span class="col1"><?=$number?></span>		
			<?php 
				$view_url = "index.php?type=view&table=$table&num=$num&page=$page";
			?>
		<span class="col2">
			<a href="<?=$view_url?>">
					<?php
						if($table=="youtube" && $file_name)
							echo "<img src='/data/".$file_copied."' width='150'>".$subject;
						else 
							echo $subject;
					?>
			</a>

		<span class="col3"><?=$name?></span>
		<span class="col4"><?=$file_image?></span>
		<span class="col5"><?=$regist_day?></span>
	</li>	
<?php
   	   $number--;
   	}
   	mysqli_close($_mysqli);
?>
	</ul>
<!-- 페이지 내비게이션 -->
	<ul class="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2) {
		$new_page = $page-1;
		echo "<li><a href='index.php?type=list&table=$table&page=$new_page'>◀ </a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++) {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
			echo "<li><b> $i </b></li>";
		else
			echo "<li> <a href='index.php?type=list&table=$table&page=$i'> $i </a> <li>";
   	}
   	if ( $page != $total_page)	{
		$new_page = $page+1;	
		echo "<li> <a href='index.php?type=list&table=$table&page=$new_page'> ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";		
?>
</ul> <!-- page -->
<ul class="buttons">
		<?php
			$list_url = "index.php?type=list&table=$table&page=$page";
		?>
	<li><button onclick="location.href='<?=$list_url?>'">목록</button></li>
		<?php
				$onclick = "location.href='index.php?type=create_board&table=$table'";
		?>
	        <li><button onclick="<?=$onclick?>">글쓰기</button></li>
</ul>
