<?php
// function createMysqlConnection()
// {
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "shopa";
//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     $conn->query('SET NAMES UTF8;');
//     return $conn;
// }

function insertNeworder_detail(
    $order_detail_id,
    $order_id,
    $product_attr_id,
    $qty
) {
    $conn = createMysqlConnection();
    $sql = "INSERT INTO order_detail(order_detail_id, order_id, product_attr_id, qty) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $order_detail_id, $order_id, $product_attr_id, $qty);

    $isSuccess = false;
    if ($stmt->execute() === TRUE) {
        $isSuccess = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
    return $isSuccess;
}


function updateorder_detail(
    $order_detail_id,
    $order_id,
    $product_attr_id,
    $qty
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE order_detail SET
                    order_detail_id =      ?, order_id =      ?, product_attr_id =      ?, qty =      ?
                    WHERE order_detail_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iiiii",
        $order_detail_id,
        $order_id,
        $product_attr_id,
        $qty,
        $order_detail_id
    );

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
function deleteorder_detail($id)
{
    $conn = createMysqlConnection();

    $sql = "DELETE FROM order_detail WHERE order_detail_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_detail_id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function getAllorder_detail()
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM order_detail ORDER BY order_detail_id";
    $result = $conn->query($sql);

    $order_details = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $order_details_row = array(
                "order_detail_id" => $row["order_detail_id"],
                "order_id" => $row["order_id"],
                "product_attr_id" => $row["product_attr_id"],
                "qty" => $row["qty"]
            );
            array_push($order_details, $order_details_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $order_details;
}

function getorder_detailByorder_detail_id($order_detail_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM order_detail WHERE order_detail_id = ?"; //////////////////////

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_detail_id);
    $stmt->execute();


    $stmt->bind_result(

        $order_detail_id,
        $order_id,
        $product_attr_id,
        $qty
    );


    $order_details = array();

    // output data of each row
    while ($stmt->fetch()) {
        $order_details_row = array(
            "order_detail_id" => $order_detail_id,
            "order_id" => $order_id,
            "product_attr_id" => $product_attr_id,
            "qty" => $qty

        );
        array_push($order_details, $order_details_row);
    }
    $stmt->close();
    $conn->close();
    return   $order_details;
}

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
function searchorder_detail($name_search, $column_name_to_search)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM order_detail WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
    echo "$sql";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name_search);
    $stmt->execute();
    //$result = $stmt->get_result();

    $stmt->bind_result(

        $order_detail_id,
        $order_id,
        $product_attr_id,
        $qty
    );


    $order_details = array();

    // output data of each row
    while ($stmt->fetch()) {
        $order_details_row = array(
            "order_detail_id" => $order_detail_id,
            "order_id" => $order_id,
            "product_attr_id" => $product_attr_id,
            "qty" => $qty

        );
        array_push($order_details, $order_details_row);
    }
    $stmt->close();
    $conn->close();
    return   $order_details;
}
