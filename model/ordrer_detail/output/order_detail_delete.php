<?php
    require_once("order_detail_function.php");
    $order_detail_id = $_GET['order_detail_id'];
    deleteorder_detail($order_detail_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="order_detail_show_all.php">กลับ</a>