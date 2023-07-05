<?php
    require_once("user_function.php");
    $user_id = $_GET['user_id'];
    deleteuser($user_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="user_show_all.php">กลับ</a>