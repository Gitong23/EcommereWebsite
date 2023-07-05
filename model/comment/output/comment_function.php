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
function insertNewcomment($comment_id, $user_id, $product_id, $content)
{
    $conn = createMysqlConnection();
    $sql = "INSERT INTO comment (comment_id, user_id, product_id, content) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $comment_id, $user_id, $product_id, $content);

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


function updatecomment(
    $comment_id,
    $user_id,
    $product_id,
    $content
) {
    $conn = createMysqlConnection();

    $sql = "UPDATE comment SET
                    comment_id =      ?, user_id =      ?, product_id =      ?, content =      ?
                    WHERE comment_id =  ?";

    echo  $sql . "<br/>";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iiisi",
        $comment_id,
        $user_id,
        $product_id,
        $content,
        $comment_id
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
function deletecomment($id)
{
    $conn = createMysqlConnection();

    $sql = "DELETE FROM comment WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function getAllcomment()
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM comment ORDER BY comment_id";
    $result = $conn->query($sql);

    $comments = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $comments_row = array(
                "comment_id" => $row["comment_id"],
                "user_id" => $row["user_id"],
                "product_id" => $row["product_id"],
                "content" => $row["content"]
            );
            array_push($comments, $comments_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $comments;
}

//create new
function getCommentByProdId($product_id)
{
    $conn = createMysqlConnection();
    $sql = "SELECT `comment_id`, `comment`.`user_id`, `product_id`, `content`,`username` FROM `comment` INNER JOIN `user` ON `user`.`user_id` = `comment`.`user_id` WHERE `product_id` = " . $product_id;
    $result = $conn->query($sql);
    $comments = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $comments_row = array(
                "comment_id" => $row["comment_id"],
                "user_id" => $row["user_id"],
                "product_id" => $row["product_id"],
                "content" => $row["content"],
                "username" => $row["username"]
            );
            array_push($comments, $comments_row);
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return   $comments;
}

function getcommentBycomment_id($comment_id)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM comment WHERE comment_id = ?"; //////////////////////

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();


    $stmt->bind_result(

        $comment_id,
        $user_id,
        $product_id,
        $content
    );


    $comments = array();

    // output data of each row
    while ($stmt->fetch()) {
        $comments_row = array(
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "product_id" => $product_id,
            "content" => $content

        );
        array_push($comments, $comments_row);
    }
    $stmt->close();
    $conn->close();
    return   $comments;
}

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
function searchcomment($name_search, $column_name_to_search)
{
    $conn = createMysqlConnection();

    $sql = "SELECT *  FROM comment WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
    echo "$sql";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name_search);
    $stmt->execute();
    //$result = $stmt->get_result();

    $stmt->bind_result(

        $comment_id,
        $user_id,
        $product_id,
        $content
    );


    $comments = array();

    // output data of each row
    while ($stmt->fetch()) {
        $comments_row = array(
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "product_id" => $product_id,
            "content" => $content

        );
        array_push($comments, $comments_row);
    }
    $stmt->close();
    $conn->close();
    return   $comments;
}
