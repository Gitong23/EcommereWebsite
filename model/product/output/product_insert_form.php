<?php
    session_start();
    require_once("product_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getproductByid($id);
	
        if(count($values) > 0)
        {
	    



		$product_id       		=   	$values[0]["product_id"] 	;
		$_SESSION["product_id"]       =  	$product_id    ;
	    

		$cat_id       		=   	$values[0]["cat_id"] 	;
		$_SESSION["cat_id"]       =  	$cat_id    ;
	    

		$product_name       		=   	$values[0]["product_name"] 	;
		$_SESSION["product_name"]       =  	$product_name    ;
	    

		$detail       		=   	$values[0]["detail"] 	;
		$_SESSION["detail"]       =  	$detail    ;
	    

		$unit_price       		=   	$values[0]["unit_price"] 	;
		$_SESSION["unit_price"]       =  	$unit_price    ;
	    

		$img1       		=   	$values[0]["img1"] 	;
		$_SESSION["img1"]       =  	$img1    ;
	    

		$img2       		=   	$values[0]["img2"] 	;
		$_SESSION["img2"]       =  	$img2    ;
	    

		$img3       		=   	$values[0]["img3"] 	;
		$_SESSION["img3"]       =  	$img3    ;
	    

		$img4       		=   	$values[0]["img4"] 	;
		$_SESSION["img4"]       =  	$img4    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [product]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสproductด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสcategoryด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกชื่อสินค้าด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 3)
	    {
		echo "<p style='color:red;'>กรุณากรอกรายละเอียดด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 4)
	    {
		echo "<p style='color:red;'>กรุณากรอกราคาต่อหน่วยด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 5)
	    {
		echo "<p style='color:red;'>กรุณากรอกfilepath1ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 6)
	    {
		echo "<p style='color:red;'>กรุณากรอกfilepath2ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 7)
	    {
		echo "<p style='color:red;'>กรุณากรอกfilepath3ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 8)
	    {
		echo "<p style='color:red;'>กรุณากรอกfilepath4ด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new product</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='product_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='product_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>product_id  <input type="text" name="product_id"         value= "<?php echo $_SESSION["product_id"];?>" /> </li>
                            

				
				<li>cat_id  <input type="text" name="cat_id"         value= "<?php echo $_SESSION["cat_id"];?>" /> </li>
                            

				
				<li>product_name  <input type="text" name="product_name"         value= "<?php echo $_SESSION["product_name"];?>" /> </li>
                            

				
				<li>detail  <input type="text" name="detail"         value= "<?php echo $_SESSION["detail"];?>" /> </li>
                            

				
				<li>unit_price  <input type="text" name="unit_price"         value= "<?php echo $_SESSION["unit_price"];?>" /> </li>
                            

				
				<li>img1  <input type="text" name="img1"         value= "<?php echo $_SESSION["img1"];?>" /> </li>
                            

				
				<li>img2  <input type="text" name="img2"         value= "<?php echo $_SESSION["img2"];?>" /> </li>
                            

				
				<li>img3  <input type="text" name="img3"         value= "<?php echo $_SESSION["img3"];?>" /> </li>
                            

				
				<li>img4  <input type="text" name="img4"         value= "<?php echo $_SESSION["img4"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>