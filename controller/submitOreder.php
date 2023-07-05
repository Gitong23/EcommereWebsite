<?php

require("../model/order/output/order_fuction.php");
require("../model/ordrer_detail/output/order_detail_function.php");
session_start();

$trans_id = 1;
if (isset($_POST["trans_id"])) {
    $trans_id = intval($_POST["trans_id"]);
}

$cart = $_SESSION['cart'];
$user_id = intval($_SESSION['user_id']);;

$key = array_keys($_SESSION['cart']);
$qty = array();

for ($i = 0; $i < count($key); $i++) {
    $s = explode(",", $cart[$key[$i]]);
    array_push($qty, intval($s[3]));
}

print_r($key);
echo "<br>";
print_r($qty);

$last_id = insertNewOrder($user_id, $trans_id);

for ($i = 0; $i < count($key); $i++) {
    insertNeworder_detail(0, $last_id, intval($key[$i]), $qty[$i]);
}

unset($_SESSION['cart']);
header("Location: ../index.php");
exit();
