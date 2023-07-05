<?php
require_once("../model/product_attr/output/product_attr_function.php");
$status = $_GET["status"];
$data = "";

if ($status == 'getAll') {
    $data = getAllDashboard();
} else if ($status == 'getBestSeller') {
    $data = getBestSeller();
} else if ($status == 'getCloseStock') {
    $data = getCloseStock();
} else if ($status == 'getOutStock') {
    $data = getOutStock();
}

$json = json_encode($data);
echo $json;
