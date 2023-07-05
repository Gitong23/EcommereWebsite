<?php
    require_once("comment_function.php");
    $comment_id = $_GET['comment_id'];
    deletecomment($comment_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="comment_show_all.php">กลับ</a>