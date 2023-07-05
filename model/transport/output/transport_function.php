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

function insertNewtransport(
    $trans_id,
    $trans_name,
    $trans_price
) {
    $conn = createMysqlConnection();
    $sql = "INSERT INTO transport
                (
        trans_id, trans_name, trans_price
                 )
                VALUES (0,
                ?, ?, ?
                )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isi",

        $trans_id,
        $trans_name,
        $trans_price

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


function updatetransport(
    $trans_id,
    $trans_name,
    $trans_price
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE transport SET
                    trans_id =      ?, trans_name =      ?, trans_price =      ?
                    WHERE trans_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isii",
        $trans_id,
        $trans_name,
        $trans_price,
        $trans_id
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
function deletetransport($id)
{
    $conn = createMysqlConnection();

    $sql = "DELETE FROM transport WHERE trans_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $trans_id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function getAlltransport()
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM transport ORDER BY trans_id";
    $result = $conn->query($sql);

    $transports = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $transports_row = array(
                "trans_id" => $row["trans_id"],
                "trans_name" => $row["trans_name"],
                "trans_price" => $row["trans_price"]
            );
            array_push($transports, $transports_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $transports;
}

//create new
function getShippingPrice($trans_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT `trans_price` FROM `transport` WHERE `trans_id`=" . $trans_id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $price = $row["trans_price"];
    $conn->close();

    return $price;
}

function gettransportBytrans_id($trans_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM transport WHERE trans_id = ?"; //////////////////////

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $trans_id);
    $stmt->execute();


    $stmt->bind_result(

        $trans_id,
        $trans_name,
        $trans_price
    );


    $transports = array();

    // output data of each row
    while ($stmt->fetch()) {
        $transports_row = array(
            "trans_id" => $trans_id,
            "trans_name" => $trans_name,
            "trans_price" => $trans_price

        );
        array_push($transports, $transports_row);
    }
    $stmt->close();
    $conn->close();
    return   $transports;
}

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
function searchtransport($name_search, $column_name_to_search)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM transport WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
    echo "$sql";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name_search);
    $stmt->execute();
    //$result = $stmt->get_result();

    $stmt->bind_result(

        $trans_id,
        $trans_name,
        $trans_price
    );


    $transports = array();

    // output data of each row
    while ($stmt->fetch()) {
        $transports_row = array(
            "trans_id" => $trans_id,
            "trans_name" => $trans_name,
            "trans_price" => $trans_price

        );
        array_push($transports, $transports_row);
    }
    $stmt->close();
    $conn->close();
    return   $transports;
}
