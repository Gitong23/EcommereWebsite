<?php
    session_start();
    require_once("product_attr_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getproduct_attrByid($id);
	
        if(count($values) > 0)
        {
	    



		$product_attr_id       		=   	$values[0]["product_attr_id"] 	;
		$_SESSION["product_attr_id"]       =  	$product_attr_id    ;
	    

		$product_id       		=   	$values[0]["product_id"] 	;
		$_SESSION["product_id"]       =  	$product_id    ;
	    

		$attr_name       		=   	$values[0]["attr_name"] 	;
		$_SESSION["attr_name"]       =  	$attr_name    ;
	    

		$product_stock       		=   	$values[0]["product_stock"] 	;
		$_SESSION["product_stock"]       =  	$product_stock    ;
	    

		$sale       		=   	$values[0]["sale"] 	;
		$_SESSION["sale"]       =  	$sale    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [product_attr]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสคุณสมบัติพิเศษด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสสินค้าด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกชื่อคุณสมบัติพิเศษด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 3)
	    {
		echo "<p style='color:red;'>กรุณากรอกจำนวนสินค้าเหลือในคลังด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 4)
	    {
		echo "<p style='color:red;'>กรุณากรอกยอดขายทั้งหมดด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new product_attr</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='product_attr_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='product_attr_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>product_attr_id  <input type="text" name="product_attr_id"         value= "<?php echo $_SESSION["product_attr_id"];?>" /> </li>
                            

				
				<li>product_id  <input type="text" name="product_id"         value= "<?php echo $_SESSION["product_id"];?>" /> </li>
                            

				
				<li>attr_name  <input type="text" name="attr_name"         value= "<?php echo $_SESSION["attr_name"];?>" /> </li>
                            

				
				<li>product_stock  <input type="text" name="product_stock"         value= "<?php echo $_SESSION["product_stock"];?>" /> </li>
                            

				
				<li>sale  <input type="text" name="sale"         value= "<?php echo $_SESSION["sale"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>