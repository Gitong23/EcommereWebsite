<?php
require_once("../model/order/output/order_fuction.php");

$json = ($_POST['dataJson']);
$data = json_decode($json);
$order_id = intval($data->order_id);
updateStatus("canceled", $order_id);
