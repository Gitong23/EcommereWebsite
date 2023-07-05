<?php
session_start();
require_once('../model/order/output/order_fuction.php');

//update stock sale
function updateStockSale($newStock, $newSale, $product_attr_id)
{
    $conn = createMysqlConnection();
    $sql = " UPDATE product_attr SET product_stock = ?, sale = ? WHERE product_attr_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $newStock, $newSale, $product_attr_id);

    $isSuccess = false;
    if ($stmt->execute()  === TRUE) {
        $isSuccess = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
    return $isSuccess;
}


$json = ($_POST['dataJson']);
$data = json_decode($json);
$order_id = intval($data->order_id);

$order = getConfirmOrder($order_id);
$isSubmit = true;

//to check product
for ($i = 0; $i < count($order); $i++) {
    if ($order[$i]["newStock"] < 0) {
        $isSubmit = false;
    }
}
if (!$isSubmit) {
    echo 0;
    exit();
}

for ($i = 0; $i < count($order); $i++) {
    updateStockSale($order[$i]["newStock"], $order[$i]["newSale"], $order[$i]["product_attr_id"]);
}

updateStatus("confirmed", $order_id);

echo 1;
