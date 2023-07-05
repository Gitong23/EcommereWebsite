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

function insertNewproduct_attr(
    $product_attr_id,
    $product_id,
    $attr_name,
    $product_stock,
    $sale
) {
    $conn = createMysqlConnection();
    $sql = "INSERT INTO product_attr
                (
        product_attr_id, product_id, attr_name, product_stock, sale
                 )
                VALUES (0,
                ?, ?, ?, ?, ?
                )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iisii",

        $product_attr_id,
        $product_id,
        $attr_name,
        $product_stock,
        $sale

    );

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

function updateproduct_attr(
    $product_attr_id,
    $product_id,
    $attr_name,
    $product_stock,
    $sale
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE product_attr SET
                    product_attr_id =      ?, product_id =      ?, attr_name =      ?, product_stock =      ?, sale =      ?
                    WHERE product_attr_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iisiii",
        $product_attr_id,
        $product_id,
        $attr_name,
        $product_stock,
        $sale,
        $product_attr_id
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

function updateproduct_attr_mini(
    $product_attr_id,
    $attr_name,
    $product_stock
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE product_attr SET
                    attr_name =      ?, product_stock =      ?
                   WHERE product_attr_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $attr_name, $product_stock, $product_attr_id);

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

function deleteproduct_attr($id)
{
    $conn = createMysqlConnection();

    $sql = "DELETE FROM product_attr WHERE product_attr_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function getAllproduct_attr()
{
    $conn = createMysqlConnection();
    $sql = "SELECT *  FROM product_attr ORDER BY product_attr_id";
    $result = $conn->query($sql);

    $product_attrs = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $product_attrs_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_id" => $row["product_id"],
                "attr_name" => $row["attr_name"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"]
            );
            array_push($product_attrs, $product_attrs_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $product_attrs;
}

function getAllDashboard()
{
    $conn = createMysqlConnection();
    $sql = "SELECT product_attr_id, `product_attr`.`product_id`, product_name, attr_name, unit_price, product_stock, sale FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` ORDER BY product_attr_id ";
    $result = $conn->query($sql);
    $product_attrs = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $product_attrs_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_id" => $row["product_id"],
                "attr_name" => $row["attr_name"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"]
            );
            array_push($product_attrs, $product_attrs_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $product_attrs;
}

//create new
function getBestSeller()
{
    $conn = createMysqlConnection();
    $sql = "SELECT product_attr_id, `product_attr`.`product_id`, product_name, attr_name, unit_price, product_stock, sale FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` ORDER BY `sale` DESC LIMIT 0,10;";
    $result = $conn->query($sql);
    $product_attrs = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $product_attrs_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_id" => $row["product_id"],
                "attr_name" => $row["attr_name"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"]
            );
            array_push($product_attrs, $product_attrs_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $product_attrs;
}

function getCloseStock()
{
    $conn = createMysqlConnection();
    $sql = "SELECT product_attr_id, `product_attr`.`product_id`, product_name, attr_name, unit_price, product_stock, sale FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` WHERE `product_stock`<6 AND `product_stock`> 0 ";
    $result = $conn->query($sql);
    $product_attrs = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $product_attrs_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_id" => $row["product_id"],
                "attr_name" => $row["attr_name"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"]
            );
            array_push($product_attrs, $product_attrs_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $product_attrs;
}

function getOutStock()
{
    $conn = createMysqlConnection();
    $sql = "SELECT product_attr_id, `product_attr`.`product_id`, product_name, attr_name, unit_price, product_stock, sale FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` WHERE `product_stock` = 0;";
    $result = $conn->query($sql);
    $product_attrs = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $product_attrs_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_id" => $row["product_id"],
                "attr_name" => $row["attr_name"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"]
            );
            array_push($product_attrs, $product_attrs_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $product_attrs;
}

function getProductAttr_ProductId_byCatId($cat_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT * FROM `product_attr` INNER JOIN product ON `product_attr`.`product_id` = `product`.`product_id` WHERE `cat_id` =" . $cat_id;
    $result = $conn->query($sql);

    $product_attrs = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $product_attrs_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_id" => $row["product_id"],
                "attr_name" => $row["attr_name"],
                "product_stock" => $row["product_stock"],
                "sale" => $row["sale"],
                "cat_id" => $row["cat_id"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"]
            );
            array_push($product_attrs, $product_attrs_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $product_attrs;
}



function getproduct_attrByproduct_attr_id($product_attr_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM product_attr WHERE product_attr_id = ?"; //////////////////////

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_attr_id);
    $stmt->execute();


    $stmt->bind_result(

        $product_attr_id,
        $product_id,
        $attr_name,
        $product_stock,
        $sale
    );


    $product_attrs = array();

    // output data of each row
    while ($stmt->fetch()) {
        $product_attrs_row = array(
            "product_attr_id" => $product_attr_id,
            "product_id" => $product_id,
            "attr_name" => $attr_name,
            "product_stock" => $product_stock,
            "sale" => $sale

        );
        array_push($product_attrs, $product_attrs_row);
    }
    $stmt->close();
    $conn->close();
    return   $product_attrs;
}

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
function searchproduct_attr($name_search, $column_name_to_search)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM product_attr WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
    echo "$sql";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name_search);
    $stmt->execute();
    //$result = $stmt->get_result();

    $stmt->bind_result(

        $product_attr_id,
        $product_id,
        $attr_name,
        $product_stock,
        $sale
    );


    $product_attrs = array();

    // output data of each row
    while ($stmt->fetch()) {
        $product_attrs_row = array(
            "product_attr_id" => $product_attr_id,
            "product_id" => $product_id,
            "attr_name" => $attr_name,
            "product_stock" => $product_stock,
            "sale" => $sale

        );
        array_push($product_attrs, $product_attrs_row);
    }
    $stmt->close();
    $conn->close();
    return   $product_attrs;
}
