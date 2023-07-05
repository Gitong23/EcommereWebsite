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

function insertNewproduct($product_id, $cat_id, $product_name, $detail, $unit_price, $img1, $img2, $img3, $img4)
{
    $conn = createMysqlConnection();
    $sql = "INSERT INTO product
                (
        product_id, cat_id, product_name, detail, unit_price, img1, img2, img3, img4
                 )
                VALUES (?,
                ?, ?, ?, ?, ?, ?, ?, ?
                )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssdssss", $product_id, $cat_id, $product_name, $detail, $unit_price, $img1, $img2, $img3, $img4);

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

function insertProduct_attr(
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
                VALUES (
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

function updateproduct(
    $product_id,
    $cat_id,
    $product_name,
    $detail,
    $unit_price,
    $img1,
    $img2,
    $img3,
    $img4
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE product SET
                    product_id =      ?, cat_id =      ?, product_name =      ?, detail =      ?, unit_price =      ?, img1 =      ?, img2 =      ?, img3 =      ?, img4 =      ?
                    WHERE product_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssdssssi",
        $product_id,
        $cat_id,
        $product_name,
        $detail,
        $unit_price,
        $img1,
        $img2,
        $img3,
        $img4,
        $product_id
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

//update score
function updateScoreProduct($product_id, $score_total, $num_user_review)
{
    $conn = createMysqlConnection();

    $sql = "UPDATE product SET score_total=?, num_user_review=? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iii",
        $score_total,
        $num_user_review,
        $product_id
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

function deleteproduct($id)
{
    $conn = createMysqlConnection();

    $sql = "DELETE FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

//revise add score   
function getAllproduct()
{
    $conn = createMysqlConnection();

    $sql = "SELECT `product_attr`.`product_id`, `product_name`, `unit_price`, `score_total`, `num_user_review`, `img1`, `img2`, `img3`, `img4`, `product`.`cat_id`, `cat_name`,SUM(`sale`) AS 'total_sale' FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` LEFT JOIN `category` ON `product`.`cat_id` = `category`.`cat_id` GROUP BY `product_attr`.`product_id`;";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $products_row = array(
                "product_id" => $row["product_id"],
                "cat_id" => $row["cat_id"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "score_total" => $row["score_total"],
                "num_user_review" => $row["num_user_review"],
                "cat_name" => "show all product",
                "img1" => $row["img1"],
                "img2" => $row["img2"],
                "img3" => $row["img3"],
                "img4" => $row["img4"],
                "total_sale" => $row["total_sale"]
            );
            array_push($products, $products_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $products;
}

//create new
function getSearchProduct($keyWord)
{
    $conn = createMysqlConnection();
    $sql = "SELECT `product_attr`.`product_id`, `product_name`, `unit_price`, `score_total`, `num_user_review`, `img1`, `img2`, `img3`, `img4`, `product`.`cat_id`, `cat_name`,SUM(`sale`) AS 'total_sale' FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` LEFT JOIN `category` ON `product`.`cat_id` = `category`.`cat_id` WHERE `product`.`product_name` LIKE '%" . trim($keyWord) . "%' GROUP BY `product_attr`.`product_id`;";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $products_row = array(
                "product_id" => $row["product_id"],
                "cat_id" => $row["cat_id"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "score_total" => $row["score_total"],
                "num_user_review" => $row["num_user_review"],
                "cat_name" => "Search Result",
                "img1" => $row["img1"],
                "img2" => $row["img2"],
                "img3" => $row["img3"],
                "img4" => $row["img4"],
                "total_sale" => $row["total_sale"]
            );
            array_push($products, $products_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $products;
}

//create new
function getBestSellerProduct()
{
    $conn = createMysqlConnection();

    $sql = "SELECT `product_attr`.`product_id`, `product_name`, `unit_price`, `score_total`, `num_user_review`, `img1`, `img2`, `img3`, `img4`, `product`.`cat_id`, `cat_name`,SUM(`sale`) AS 'total_sale' FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` LEFT JOIN `category` ON `product`.`cat_id` = `category`.`cat_id` GROUP BY `product_attr`.`product_id` ORDER BY SUM(`sale`) DESC LIMIT 0,10;";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $products_row = array(
                "product_id" => $row["product_id"],
                "cat_id" => $row["cat_id"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "score_total" => $row["score_total"],
                "num_user_review" => $row["num_user_review"],
                "cat_name" => "Top 10 Best Seller",
                "img1" => $row["img1"],
                "img2" => $row["img2"],
                "img3" => $row["img3"],
                "img4" => $row["img4"],
                "total_sale" => $row["total_sale"]
            );
            array_push($products, $products_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $products;
}

//create new 
function getSelectAttr($product_attr_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT product_attr_id, product_name, attr_name, unit_price, product_stock FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` WHERE `product_attr_id`=" . $product_attr_id;
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $products_row = array(
                "product_attr_id" => $row["product_attr_id"],
                "product_name" => $row["product_name"],
                "attr_name" => $row["attr_name"],
                "unit_price" => $row["unit_price"],
                "stock" => $row["product_stock"],
            );
            array_push($products, $products_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $products;
}


//create new
function getProductByCatId($cat_id)
{

    $conn = createMysqlConnection();
    // $sql = "SELECT *  FROM product WHERE cat_id =" . $cat_id;

    $sql = "SELECT `product_attr`.`product_id`, `product_name`, `unit_price`, `score_total`, `num_user_review`, `img1`, `img2`, `img3`, `img4`, `product`.`cat_id`, `cat_name`,SUM(`sale`) AS 'total_sale' FROM `product_attr` LEFT JOIN `product` ON `product_attr`.`product_id` = `product`.`product_id` LEFT JOIN `category` ON `product`.`cat_id` = `category`.`cat_id` WHERE `product`.`cat_id` = " . $cat_id . " GROUP BY `product_attr`.`product_id`;";

    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $products_row = array(
                "product_id" => $row["product_id"],
                "cat_id" => $row["cat_id"],
                "product_name" => $row["product_name"],
                "unit_price" => $row["unit_price"],
                "score_total" => $row["score_total"],
                "num_user_review" => $row["num_user_review"],
                "cat_name" => $row["cat_name"],
                "img1" => $row["img1"],
                "img2" => $row["img2"],
                "img3" => $row["img3"],
                "img4" => $row["img4"],
                "total_sale" => $row["total_sale"]
            );
            array_push($products, $products_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $products;
}


//create new
function getProductJoinAttrById($product_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT *,SUM(`sale`) OVER() AS 'total_sale' FROM `product` INNER JOIN `product_attr` ON `product`.`product_id` = `product_attr`.`product_id` INNER JOIN `category` ON `category`.`cat_id` = `product`.`cat_id` WHERE `product`.`product_id` = " . $product_id;
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $products_row = array(
                "product_id" => $row["product_id"],
                "cat_id" => $row["cat_id"],
                "product_name" => $row["product_name"],
                "detail" => $row["detail"],
                "unit_price" => $row["unit_price"],
                "score_total" => $row["score_total"],
                "num_user_review" => $row["num_user_review"],
                "cat_name" => $row["cat_name"],
                "img1" => $row["img1"],
                "img2" => $row["img2"],
                "img3" => $row["img3"],
                "img4" => $row["img4"],
                "product_attr_id" => $row["product_attr_id"],
                "attr_name" => $row["attr_name"],
                "product_stock" => $row["product_stock"],
                "total_sale" => $row["total_sale"]

            );
            array_push($products, $products_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $products;
}


function getLastestproductId()
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM product ORDER BY product_id DESC LIMIT 0,1";
    $result = $conn->query($sql);

    $lastestId = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $lastestId  = $row["product_id"];
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $lastestId;
}

function getproductByproduct_id($product_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM product WHERE product_id = ?"; //////////////////////

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();


    $stmt->bind_result(

        $product_id,
        $cat_id,
        $product_name,
        $detail,
        $unit_price,
        $img1,
        $img2,
        $img3,
        $img4
    );


    $products = array();

    // output data of each row
    while ($stmt->fetch()) {
        $products_row = array(
            "product_id" => $product_id,
            "cat_id" => $cat_id,
            "product_name" => $product_name,
            "detail" => $detail,
            "unit_price" => $unit_price,
            "img1" => $img1,
            "img2" => $img2,
            "img3" => $img3,
            "img4" => $img4

        );
        array_push($products, $products_row);
    }
    $stmt->close();
    $conn->close();
    return   $products;
}

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
function searchproduct($name_search, $column_name_to_search)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM product WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
    echo "$sql";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name_search);
    $stmt->execute();
    //$result = $stmt->get_result();

    $stmt->bind_result(

        $product_id,
        $cat_id,
        $product_name,
        $detail,
        $unit_price,
        $img1,
        $img2,
        $img3,
        $img4
    );


    $products = array();

    // output data of each row
    while ($stmt->fetch()) {
        $products_row = array(
            "product_id" => $product_id,
            "cat_id" => $cat_id,
            "product_name" => $product_name,
            "detail" => $detail,
            "unit_price" => $unit_price,
            "img1" => $img1,
            "img2" => $img2,
            "img3" => $img3,
            "img4" => $img4

        );
        array_push($products, $products_row);
    }
    $stmt->close();
    $conn->close();
    return   $products;
}
