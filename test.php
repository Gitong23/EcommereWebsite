<?php
session_start();
require_once("model/order/output/order_fuction.php");
$order = getOrderViewByUserId(13);

print_r($order);
echo "<br>";
echo "<br>";
echo "<br>";
print_r($_SESSION);
