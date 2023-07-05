<?php
require_once("../model/product/output/product_function.php");

$product_attr_id = $_GET["attr_id"];
$data = getSelectAttr(intval($product_attr_id));
$json = json_encode($data);

echo $json;
