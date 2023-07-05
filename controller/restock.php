<?php

    require_once("../model/product_attr/output/product_attr_function.php");

    $product_attr_id = intval($_POST["attrid"]);
    $product_attr_name = $_POST["attr_name"];
    $product_attr_inStock = intval($_POST["attr_stock"]);
    $cat_id = $_POST["catid"];

    if(updateproduct_attr_mini($product_attr_id, $product_attr_name, $product_attr_inStock))
    {
        header("Location: http://localhost/shopa/views/dashboard/manage_product.php?return=".$cat_id);
        exit();
    }
    else
    {
        header("Location: http://localhost/shopa/views/editProductAttr.php?product_attr=".$product_attr_id);
        exit();
    }

?>