<?php
require_once('../model/order/output/order_fuction.php');

$order_id = $_GET["order_id"];
$data = getOrderListByOrderId($order_id);
$json = json_encode($data);

echo $json;
