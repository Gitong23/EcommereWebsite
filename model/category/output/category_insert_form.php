<?php
    session_start();
    require_once("category_function.php");
    
    $isEdit = false;
    if(isset( $_GET['action'] ) and  $_GET['action'] == "edit" )
    {
        $isEdit = true;
        $id = $_GET['id'];
        $values = getcategoryByid($id);
	
        if(count($values) > 0)
        {
	    



		$cat_id       		=   	$values[0]["cat_id"] 	;
		$_SESSION["cat_id"]       =  	$cat_id    ;
	    

		$cat_name       		=   	$values[0]["cat_name"] 	;
		$_SESSION["cat_name"]       =  	$cat_name    ;
	    

            
        }
    }
?>
<html>
	<head>
		<title>MM's Bag [category]</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
    <?php

      
	



	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 0)
	    {
		echo "<p style='color:red;'>กรุณากรอกรหัสหมวดหมู่ด้วยค่ะ</p>";
	    }
       

	    
	    if(isset( $_GET['return'] ) and $_GET['return'] == 1)
	    {
		echo "<p style='color:red;'>กรุณากรอกชื่อสำหรับ categoryด้วยค่ะ</p>";
	    }
       

       
   ?>
		<h1>insert new category</h1>
                <?php
                    if($isEdit)
                    {
                        echo "<form action='category_update_action.php' method='POST'>";
                    }
                    else
                    {
                        echo "<form action='category_insert_action.php' method='POST'>";
                    }
                ?>
                    <ul>
                            <?php
                                if($isEdit)
                                {
                                    echo "<input type='hidden' name='id'         value= '$id;' />";
                                }
                            ?>
			    



				
				<li>cat_id  <input type="text" name="cat_id"         value= "<?php echo $_SESSION["cat_id"];?>" /> </li>
                            

				
				<li>cat_name  <input type="text" name="cat_name"         value= "<?php echo $_SESSION["cat_name"];?>" /> </li>
                            

       
			    <li> <input type="submit" name="submit" value="SAVE" /> </li>
                    </ul>
                </form>
               
	<body>
</html>