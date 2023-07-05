<?php

    require_once("../model/product_attr/output/product_attr_function.php");

    $cat_id = intval($_GET["cat_id"]);
    $data = getProductAttr_ProductId_byCatId($cat_id);
    $json = json_encode($data);

    echo $json;
?>