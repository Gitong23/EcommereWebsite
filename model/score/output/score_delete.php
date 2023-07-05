<?php
    require_once("score_function.php");
    $score_id = $_GET['score_id'];
    deletescore($score_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="score_show_all.php">กลับ</a>