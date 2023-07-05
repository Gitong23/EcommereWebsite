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

//create new 

function checkUserScore($user_id, $product_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT `score_id` FROM `score` WHERE `user_id` = " . $user_id . " AND `product_id`=" . $product_id;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $conn->close();
        return true;
    }

    $conn->close();
    return false;
}

function insertNewscore($score_id, $user_id, $product_id, $score)
{
    $conn = createMysqlConnection();
    $sql = "INSERT INTO score (score_id, user_id, product_id, score) VALUES (? , ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $score_id, $user_id, $product_id, $score);

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


function updatescore(
    $score_id,
    $user_id,
    $product_id
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE score SET
                    score_id =      ?, user_id =      ?, product_id =      ?
                    WHERE score_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iisi",
        $score_id,
        $user_id,
        $product_id,
        $score_id
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
function deletescore($id)
{
    $conn = createMysqlConnection();

    $sql = "DELETE FROM score WHERE score_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $score_id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function getAllscore()
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM score ORDER BY score_id";
    $result = $conn->query($sql);

    $scores = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $scores_row = array(
                "score_id" => $row["score_id"],
                "user_id" => $row["user_id"],
                "product_id" => $row["product_id"]
            );
            array_push($scores, $scores_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $scores;
}

function getscoreByscore_id($score_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM score WHERE score_id = ?"; //////////////////////

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $score_id);
    $stmt->execute();


    $stmt->bind_result(

        $score_id,
        $user_id,
        $product_id
    );


    $scores = array();

    // output data of each row
    while ($stmt->fetch()) {
        $scores_row = array(
            "score_id" => $score_id,
            "user_id" => $user_id,
            "product_id" => $product_id

        );
        array_push($scores, $scores_row);
    }
    $stmt->close();
    $conn->close();
    return   $scores;
}

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
function searchscore($name_search, $column_name_to_search)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM score WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
    echo "$sql";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name_search);
    $stmt->execute();
    //$result = $stmt->get_result();

    $stmt->bind_result(

        $score_id,
        $user_id,
        $product_id
    );


    $scores = array();

    // output data of each row
    while ($stmt->fetch()) {
        $scores_row = array(
            "score_id" => $score_id,
            "user_id" => $user_id,
            "product_id" => $product_id

        );
        array_push($scores, $scores_row);
    }
    $stmt->close();
    $conn->close();
    return   $scores;
}
