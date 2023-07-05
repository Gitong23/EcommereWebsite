<?php
    session_start();
    require_once("score_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getscoreByid($id);
	
        if(count($values) > 0)
        {
	    



		$score_id       		=   	$values[0]["score_id"] 	;
		$_SESSION["score_id"]       =  	$score_id    ;
	    

		$user_id       		=   	$values[0]["user_id"] 	;
		$_SESSION["user_id"]       =  	$user_id    ;
	    

		$product_id       		=   	$values[0]["product_id"] 	;
		$_SESSION["product_id"]       =  	$product_id    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [score]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสคะแนนด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสผู้ใช้ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกสินค้าที่ถูกให้คะแนนด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new score</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='score_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='score_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>score_id  <input type="text" name="score_id"         value= "<?php echo $_SESSION["score_id"];?>" /> </li>
                            

				
				<li>user_id  <input type="text" name="user_id"         value= "<?php echo $_SESSION["user_id"];?>" /> </li>
                            

				
				<li>product_id  <input type="text" name="product_id"         value= "<?php echo $_SESSION["product_id"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>