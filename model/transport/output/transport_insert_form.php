<?php
    session_start();
    require_once("transport_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = gettransportByid($id);
	
        if(count($values) > 0)
        {
	    



		$trans_id       		=   	$values[0]["trans_id"] 	;
		$_SESSION["trans_id"]       =  	$trans_id    ;
	    

		$trans_name       		=   	$values[0]["trans_name"] 	;
		$_SESSION["trans_name"]       =  	$trans_name    ;
	    

		$trans_price       		=   	$values[0]["trans_price"] 	;
		$_SESSION["trans_price"]       =  	$trans_price    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [transport]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสการส่งด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกชื่อการส่งด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 2)
	    {
		echo "<p style='color:red;'>กรุณากรอกราคาขนส่งด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new transport</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='transport_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='transport_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>trans_id  <input type="text" name="trans_id"         value= "<?php echo $_SESSION["trans_id"];?>" /> </li>
                            

				
				<li>trans_name  <input type="text" name="trans_name"         value= "<?php echo $_SESSION["trans_name"];?>" /> </li>
                            

				
				<li>trans_price  <input type="text" name="trans_price"         value= "<?php echo $_SESSION["trans_price"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>