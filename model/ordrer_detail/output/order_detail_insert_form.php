<?php
    session_start();
    require_once("order_detail_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getorder_detailByid($id);
	
        if(count($values) > 0)
        {
	    



		$order_detail_id       		=   	$values[0]["order_detail_id"] 	;
		$_SESSION["order_detail_id"]       =  	$order_detail_id    ;
	    

		$order_id       		=   	$values[0]["order_id"] 	;
		$_SESSION["order_id"]       =  	$order_id    ;
	    

		$product_attr_id       		=   	$values[0]["product_attr_id"] 	;
		$_SESSION["product_attr_id"]       =  	$product_attr_id    ;
	    

		$qty       		=   	$values[0]["qty"] 	;
		$_SESSION["qty"]       =  	$qty    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [order_detail]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสorder_detailด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสการซื้อด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสสินค้าด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 3)
	    {
		echo "<p style='color:red;'>กรุณากรอกจำนวนสินค้าด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new order_detail</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='order_detail_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='order_detail_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>order_detail_id  <input type="text" name="order_detail_id"         value= "<?php echo $_SESSION["order_detail_id"];?>" /> </li>
                            

				
				<li>order_id  <input type="text" name="order_id"         value= "<?php echo $_SESSION["order_id"];?>" /> </li>
                            

				
				<li>product_attr_id  <input type="text" name="product_attr_id"         value= "<?php echo $_SESSION["product_attr_id"];?>" /> </li>
                            

				
				<li>qty  <input type="text" name="qty"         value= "<?php echo $_SESSION["qty"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>