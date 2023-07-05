<?php
    require_once("transport_function.php");
    $trans_id = $_GET['trans_id'];
    deletetransport($trans_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="transport_show_all.php">กลับ</a>