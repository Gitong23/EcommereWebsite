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

    function insertNewuser($user_id, $username, $password, $email, $user_status)
    {
        $conn= createMysqlConnection();
        $sql = "INSERT INTO user (user_id, username, password, email, user_status)VALUES (? ,?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt-> bind_param("issss",$user_id, $username, $password, $email, $user_status);
        
        $isSuccess = false;
        if ($stmt->execute() === TRUE)
        {
            $isSuccess = true;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();
        return $isSuccess;
    }
    
    
    function updateuser(
         $user_id, $username, $password, $email, $user_status
                )
    {
        $conn= createMysqlConnection();
        
        $sql = "UPDATE user SET
                    user_id =      ?, username =      ?, password =      ?, email =      ?, user_status =      ?
                    WHERE user_id =  ?";
                    
        echo  $sql."<br/>";
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("issssi", 
                            $user_id, $username, $password, $email, $user_status
                           
                           ,$user_id);
        
        $isSuccess = false;
        if ($stmt->execute()  === TRUE)
        {
            $isSuccess = true;
        } else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();
        return $isSuccess;

    }
    function deleteuser($id)
    {
        $conn= createMysqlConnection();
        
        $sql = "DELETE FROM user WHERE user_id = ?" ;
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("i",$user_id);
        
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();

    }
       
    function getAlluser()
    {
        $conn= createMysqlConnection();
        
        $sql = "SELECT *  FROM user ORDER BY user_id";
        $result = $conn->query($sql);
        
        $users = array();
        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                $users_row = array(
                            "user_id"=>$row["user_id"],
                                "username"=>$row["username"],
                                "password"=>$row["password"],
                                "email"=>$row["email"],
                                "user_status"=>$row["user_status"]
                                       );
                array_push($users,$users_row);
            }
        } else {
            echo "0 results";
        }
        
        $conn->close();
        return   $users;
    }

    function getuserByuser_id($user_id)
    {
        $conn= createMysqlConnection();
        
        $sql = "SELECT *  FROM user WHERE user_id = ?"; //////////////////////
        
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("i",$user_id);
        $stmt->execute();
        
        
        $stmt->bind_result(
                           
                            $user_id, $username, $password, $email, $user_status
                          );
       
        
        $users = array();
       
        // output data of each row
        while($stmt->fetch())
        {
            $users_row = array(
                            "user_id"=>$user_id,
                                "username"=>$username,
                                "password"=>$password,
                                "email"=>$email,
                                "user_status"=>$user_status
                                    
                                   );
            array_push($users,$users_row);
        }
        $stmt->close();
        $conn->close();
        return   $users;
    }

    function searchuser($name_search,$column_name_to_search)
    {
        $conn= createMysqlConnection();
        
        $sql = "SELECT *  FROM user WHERE `$column_name_to_search` LIKE ? "; //////////////////////
        // echo "$sql";
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("s",$name_search);
        $stmt->execute();
        //$result = $stmt->get_result();
        
        $stmt->bind_result($user_id, $username, $password, $email, $user_status);
    
        $users = array();
       
        // output data of each row
        while($stmt->fetch())
        {
            $users_row = array(
                            "user_id"=>$user_id,
                                "username"=>$username,
                                "password"=>$password,
                                "email"=>$email,
                                "user_status"=>$user_status
                                    
                                   );
            array_push($users,$users_row);
        }
        $stmt->close();
        $conn->close();
        return   $users;
    }
?>