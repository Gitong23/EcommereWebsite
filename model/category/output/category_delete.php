<?php
    require_once("category_function.php");
    $cat_id = $_GET['cat_id'];
    deletecategory($cat_id);
    

?>

ลบข้อมูลเรียบร้อยแล้ว
<br/>
<a href="category_show_all.php">กลับ</a>