<?php
require_once("../model/product/output/product_function.php");

$product_id = intval(trim($_GET['product_id']));
$data = getProductJoinAttrById($product_id);
$json = json_encode($data);

echo $json;
