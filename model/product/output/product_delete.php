<?php
    require_once("product_function.php");
    $product_id = $_GET['product_id'];
    deleteproduct($product_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="product_show_all.php">กลับ</a>