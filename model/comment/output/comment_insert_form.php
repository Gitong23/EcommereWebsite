<?php
    session_start();
    require_once("comment_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getcommentByid($id);
	
        if(count($values) > 0)
        {
	    



		$comment_id       		=   	$values[0]["comment_id"] 	;
		$_SESSION["comment_id"]       =  	$comment_id    ;
	    

		$user_id       		=   	$values[0]["user_id"] 	;
		$_SESSION["user_id"]       =  	$user_id    ;
	    

		$product_id       		=   	$values[0]["product_id"] 	;
		$_SESSION["product_id"]       =  	$product_id    ;
	    

		$content       		=   	$values[0]["content"] 	;
		$_SESSION["content"]       =  	$content    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [comment]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสคอมเมนต์ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสผู้เจ้าของคอมเมนต์ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสสินค้าด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 3)
	    {
		echo "<p style='color:red;'>กรุณากรอกข้อความด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new comment</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='comment_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='comment_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>comment_id  <input type="text" name="comment_id"         value= "<?php echo $_SESSION["comment_id"];?>" /> </li>
                            

				
				<li>user_id  <input type="text" name="user_id"         value= "<?php echo $_SESSION["user_id"];?>" /> </li>
                            

				
				<li>product_id  <input type="text" name="product_id"         value= "<?php echo $_SESSION["product_id"];?>" /> </li>
                            

				
				<li>content  <input type="text" name="content"         value= "<?php echo $_SESSION["content"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>