<?php
require_once("../model/order/output/order_fuction.php");

$data = getWaitingOrder();
$json = json_encode($data);

echo $json;
