<?php
    session_start();
    require_once("user_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getuserByid($id);
	
        if(count($values) > 0)
        {
	    



		$user_id       		=   	$values[0]["user_id"] 	;
		$_SESSION["user_id"]       =  	$user_id    ;
	    

		$username       		=   	$values[0]["username"] 	;
		$_SESSION["username"]       =  	$username    ;
	    

		$password       		=   	$values[0]["password"] 	;
		$_SESSION["password"]       =  	$password    ;
	    

		$email       		=   	$values[0]["email"] 	;
		$_SESSION["email"]       =  	$email    ;
	    

		$user_status       		=   	$values[0]["user_status"] 	;
		$_SESSION["user_status"]       =  	$user_status    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [user]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสuserด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกชื่อสำหรับ loginด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 3)
	    {
		echo "<p style='color:red;'>กรุณากรอกอีเมลล์ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 4)
	    {
		echo "<p style='color:red;'>กรุณากรอกสถานะด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new user</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='user_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='user_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>user_id  <input type="text" name="user_id"         value= "<?php echo $_SESSION["user_id"];?>" /> </li>
                            

				
				<li>username  <input type="text" name="username"         value= "<?php echo $_SESSION["username"];?>" /> </li>
                            

				
				<li>password  <input type="text" name="password"         value= "<?php echo $_SESSION["password"];?>" /> </li>
                            

				
				<li>email  <input type="text" name="email"         value= "<?php echo $_SESSION["email"];?>" /> </li>
                            

				
				<li>user_status  <input type="text" name="user_status"         value= "<?php echo $_SESSION["user_status"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>