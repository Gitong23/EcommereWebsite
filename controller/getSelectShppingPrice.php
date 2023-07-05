<?php
require_once("../model/transport/output/transport_function.php");

$trans_id = $_GET['trans_id'];

$price = getShippingPrice($trans_id);

echo $price;
