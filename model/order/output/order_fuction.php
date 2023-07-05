<?php
function createMysqlConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shopa";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->query('SET NAMES UTF8;');
    return $conn;
}


function insertNewOrder($user_id, $trans_id)
{
    $conn = createMysqlConnection();
    $sql = "INSERT INTO `order` (order_id, user_id, trans_id, status) VALUES (0," . $user_id . "," . $trans_id . ", 'waiting confirm')";


    if ($conn->query($sql) === TRUE) {
        echo "Insert Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT `order_id` FROM `order` ORDER BY `order_id` DESC LIMIT 0,1;";
    $result = $conn->query($sql)->fetch_assoc();
    $lastest = intval($result["order_id"]);

    $conn->close();

    return $lastest;
}


function getOrderViewByUserId($user_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT `order`.`order_id`, `order`.`user_id`, `order`.`trans_id`, trans_name, trans_price, status, last_update, `order_detail`.`product_attr_id`, qty, unit_price, (SUM(qty * unit_price)+trans_price) AS 'total' FROM `order` INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`order_id` INNER JOIN `product_attr` ON `order_detail`.`product_attr_id` = `product_attr`.`product_attr_id` INNER JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` INNER JOIN `transport` ON `order`.`trans_id` = `transport`.`trans_id` WHERE `user_id` = " . $user_id . " GROUP BY `order`.`order_id`;";

    $result = $conn->query($sql);

    $order = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $order_row = array(
                "order_id" => $row["order_id"],
                "user_id" => $row["user_id"],
                "trans_id" => $row["trans_id"],
                "trans_name" => $row["trans_name"],
                "trans_price" => $row["trans_price"],
                "status" => $row["status"],
                "last_update" => $row["last_update"],
                "product_attr_id" => $row["product_attr_id"],
                "total" => $row["total"]
            );
            array_push($order, $order_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $order;
}

function getOrderListByOrderId($order_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT product_name, qty, unit_price, (`qty`*`unit_price`) AS 'price' FROM `order` INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`order_id` INNER JOIN `product_attr` ON `order_detail`.`product_attr_id` = `product_attr`.`product_attr_id` INNER JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` WHERE `order`.`order_id` = " . $order_id;
    $result = $conn->query($sql);
    $order = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $order_row = array(
                "product_name" => $row["product_name"],
                "qty" => $row["qty"],
                "unit_price" => $row["unit_price"],
                "price" => $row["price"]
            );
            array_push($order, $order_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $order;
}

function getWaitingOrder()
{
    $conn = createMysqlConnection();
    $sql = "SELECT `order`.`order_id`,`order`.`user_id`, `order`.`last_update`, `order`.`status`, `transport`.`trans_name`, `transport`.`trans_price`,product_name, qty, unit_price, (SUM(`qty`*`unit_price`)+`trans_price`) AS 'total' FROM `order` INNER JOIN `transport` ON `transport`.`trans_id` = `order`.`trans_id` INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`order_id` INNER JOIN `product_attr` ON `order_detail`.`product_attr_id` = `product_attr`.`product_attr_id` INNER JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` WHERE `order`.`status` LIKE '%waiting%' GROUP BY `order`.`order_id`;";
    $result = $conn->query($sql);
    $order = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $order_row = array(
                "order_id" => $row["order_id"],
                "user_id" => $row["user_id"],
                "last_update" => $row["last_update"],
                "status" => $row["status"],
                "trans_name" => $row["trans_name"],
                "total" => $row["total"]
            );
            array_push($order, $order_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $order;
}

function getConfirmOrder($order_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT `order`.`order_id`, `product_attr`.`product_attr_id`, qty, product_stock, sale, (`product_stock` - `qty`) AS 'newStock', (`qty`+`sale`) AS 'newSale' FROM `order` INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`order_id` INNER JOIN `product_attr` ON `order_detail`.`product_attr_id` = `product_attr`.`product_attr_id` WHERE `order`.`order_id`=" . $order_id;
    $result = $conn->query($sql);
    $order = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $order_row = array(
                "order_id" => $row["order_id"],
                "product_attr_id" => $row["product_attr_id"],
                "qty" => $row["qty"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"],
                "newStock" => $row["newStock"],
                "newSale" => $row["newSale"]
            );
            array_push($order, $order_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $order;
}

function updateStatus($status, $order_id)
{
    $conn = createMysqlConnection();
    $sql = "UPDATE `order` SET status = ? WHERE order_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);

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
