<?php

    require_once("../model/product_attr/output/product_attr_function.php");

    $product_attr_id = intval($_GET["product_attr"]);
    $cat_id = $_GET["cat_id"];

    deleteproduct_attr($product_attr_id);

    header("Location: http://localhost/shopa/views/dashboard/manage_product.php?return=".$cat_id);
    exit();

?>