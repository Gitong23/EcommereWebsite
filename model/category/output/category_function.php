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
    function insertNewcategory(
        $cat_id, $cat_name
                )
    {
        $conn= createMysqlConnection();
        $sql = "INSERT INTO category
                (
        cat_id, cat_name
                 )
                VALUES (0,
                ?, ?
                )";
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("is",
                           
                $cat_id, $cat_name
                           
                           );
        
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
    
    
    function updatecategory(
         $cat_id, $cat_name
                )
    {
        $conn= createMysqlConnection();
        
        $sql = "UPDATE category SET
                    cat_id =      ?, cat_name =      ?
                    WHERE cat_id =  ?";
                    
        echo  $sql."<br/>";
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("isi", 
                            $cat_id, $cat_name
                           
                           ,$cat_id);
        
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
    function deletecategory($id)
    {
        $conn= createMysqlConnection();
        
        $sql = "DELETE FROM category WHERE cat_id = ?" ;
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("i",$cat_id);
        
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();

    }
       
    function getAllcategory()
    {
        $conn= createMysqlConnection();
        
        $sql = "SELECT *  FROM category ORDER BY cat_id";
        $result = $conn->query($sql);
        
        $categorys = array();
        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                $categorys_row = array(
                            "cat_id"=>$row["cat_id"],
                                "cat_name"=>$row["cat_name"]
                                       );
                array_push($categorys,$categorys_row);
            }
        } else {
            echo "0 results";
        }
        
        $conn->close();
        return   $categorys;
    }

    function getcategoryBycat_id($cat_id)
    {
        $conn= createMysqlConnection();
        
        $sql = "SELECT *  FROM category WHERE cat_id = ?"; //////////////////////
        
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("i",$cat_id);
        $stmt->execute();
        
        
        $stmt->bind_result(
                           
                            $cat_id, $cat_name
                          );
       
        
        $categorys = array();
       
        // output data of each row
        while($stmt->fetch())
        {
            $categorys_row = array(
                            "cat_id"=>$cat_id,
                                "cat_name"=>$cat_name
                                    
                                   );
            array_push($categorys,$categorys_row);
        }
       $stmt->close();
        $conn->close();
        return   $categorys;
    }

//%' AND  '1' =  '1' UNION SELECT * , 1, 1, 1 FROM  `users`  WHERE '1' = '1
    function searchcategory($name_search,$column_name_to_search)
    {
        $conn= createMysqlConnection();
        
        $sql = "SELECT *  FROM category WHERE `$column_name_to_search` LIKE ?   "; //////////////////////
        echo "$sql";
        $stmt = $conn->prepare( $sql);
        $stmt-> bind_param("s",$name_search);
        $stmt->execute();
        //$result = $stmt->get_result();
        
        $stmt->bind_result(
                           
                            $cat_id, $cat_name
                          );
       
        
        $categorys = array();
       
        // output data of each row
        while($stmt->fetch())
        {
            $categorys_row = array(
                            "cat_id"=>$cat_id,
                                "cat_name"=>$cat_name
                                    
                                   );
            array_push($categorys,$categorys_row);
        }
        $stmt->close();
        $conn->close();
        return   $categorys;
    }
?>