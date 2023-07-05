<?php
    require_once("category_function.php");
    session_start();

    
    
$cat_id      =   trim($_POST['cat_id']);
$cat_name      =   trim($_POST['cat_name']);
    
    $submit      =  $_POST['submit'];
    
    
$_SESSION["cat_id"]      =  $cat_id        ;
$_SESSION["cat_name"]      =  $cat_name        ;
    
    if(!isset($submit))
    {
        header("location:category_insert_form.php");
    }


    
if($cat_id == "")
            {
                header("location:category_insert_form.php?return=0");
                exit;
            }
if($cat_name == "")
            {
                header("location:category_insert_form.php?return=1");
                exit;
            }

    
   // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //    header("location:insert_form.php?return=5");
    //    exit; 
    //}
    
   $isSuccess = insertNewcategory(               
        $cat_id, $cat_name 
                                        );
   
   
   // remove all session variables
    session_unset(); 
    
    // destroy the session 
    session_destroy(); 
 
?>
<html>
    <head>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <h1><?php echo $isSuccess ? "insert สำเร็จ"  : "ล้มเหลว"; ?></h1>
        <br/>
        <a href="index.php">กลับหน้าหลัก</a>
        <br/>
        <a href="category_insert_form.php">กลับหน้าinsert new customer</a> 
    </body>
</html>
