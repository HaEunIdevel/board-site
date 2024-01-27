<div class="notice">
    <h4>공지 게시판</h4>
<?php
    include "../include/db_connect.php";

	$sql = "select * from NOTICE order by N_SEQ desc limit 5";
    $result = $_mysqli->query($sql);
    
    while($row = mysqli_fetch_assoc($result)) {
		$num    = $row["SEQ"];
		$name    = $row["MEM_NAME"];
		$date    = $row["CREATED_AT"];
	  	$date = substr($date, 0, 10);

		$subject = $row["SUBJECT"];
	  	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
?>
        <div class="item">
            <span class="col1"><a href="../index.php?type=view&table=notice&num=<?=$num?>&page=1">
                <?=$subject ?></a>
            </span>
            <span class="col2"><?=$date?></span>
        </div>
<?php
	}
?>
</div> <!-- 공지게시판 끝 -->

<div class="qna">
    <h4>QNA 게시판</h4>
<?php
	$sql = "select * from QNA order by Q_SEQ desc limit 5";
    $result = $_mysqli->query($sql);
    
    
    while($row = mysqli_fetch_assoc($result))
	{
        $num    = $row["Q_SEQ"];
        $name    = $row["MEM_NAME"];
        $date    = $row["CREATED_AT"];
	  	$date = substr($date, 0, 10);

		$subject = $row["subject"];
	  	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
?>
        <div class="item">
            <span class="col1"><a href="../index.php?type=view&table=qna&num=<?=$num?>&page=1">
                <?=$subject ?></a>
                <?php
					$sql = "select * from QNA_RIPPLE where parent=$num";
                    $result2 = $_mysqli->query($sql);
                    $num_ripple = mysqli_num_rows($result2);

					if ($num_ripple)
				 		echo " [$num_ripple]";
	  			?>
            </span>
            <span class="col2"><?=$date?></span>
        </div>
<?php
	}

	mysqli_close($_mysqli);
?>
</div> <!-- QNA 게시판 끝 -->