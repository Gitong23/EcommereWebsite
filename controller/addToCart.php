<?php

session_start();

$json = ($_POST['dataJson']);
$data = json_decode($json);

$product_attr_id = intval($data->attrId);
$product_name = $data->product_name;
$attr_name = $data->attr_name;
$unit_price = $data->unit_price;
$qty = intval($data->qty);

// $orderDetail = array();
$_SESSION["cart"][$product_attr_id . ""] = $product_name . "," . $attr_name . "," . $unit_price . "," . $qty;
exit();
