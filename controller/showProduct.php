<?php

require_once('../model/product/output/product_function.php');

$cat_id = $_GET['cat_id'];

if (isset($_GET['cat_id'])) {
    if ($cat_id == 'showall') {
        $data = getAllproduct();
    } else if ($cat_id == 'best') {
        $data = getBestSellerProduct();
    } else {
        $data = getProductByCatId(intval($cat_id));
    }
}

$json = json_encode($data);
echo $json;
