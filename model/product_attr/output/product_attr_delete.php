<?php
    require_once("product_attr_function.php");
    $product_attr_id = $_GET['product_attr_id'];
    deleteproduct_attr($product_attr_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="product_attr_show_all.php">กลับ</a>