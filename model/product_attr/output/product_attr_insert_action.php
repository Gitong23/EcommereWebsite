<?php
    require_once("product_attr_function.php");
    session_start();

    
    
$product_attr_id      =   trim($_POST['product_attr_id']);
$product_id      =   trim($_POST['product_id']);
$attr_name      =   trim($_POST['attr_name']);
$product_stock      =   trim($_POST['product_stock']);
$sale      =   trim($_POST['sale']);
    
    $submit      =  $_POST['submit'];
    
    
$_SESSION["product_attr_id"]      =  $product_attr_id        ;
$_SESSION["product_id"]      =  $product_id        ;
$_SESSION["attr_name"]      =  $attr_name        ;
$_SESSION["product_stock"]      =  $product_stock        ;
$_SESSION["sale"]      =  $sale        ;
    
    if(!isset($submit))
    {
        header("location:product_attr_insert_form.php");
    }


    
if($product_attr_id == "")
            {
                header("location:product_attr_insert_form.php?return=0");
                exit;
            }
if($product_id == "")
            {
                header("location:product_attr_insert_form.php?return=1");
                exit;
            }
if($attr_name == "")
            {
                header("location:product_attr_insert_form.php?return=2");
                exit;
            }
if($product_stock == "")
            {
                header("location:product_attr_insert_form.php?return=3");
                exit;
            }
if($sale == "")
            {
                header("location:product_attr_insert_form.php?return=4");
                exit;
            }

    
   // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //    header("location:insert_form.php?return=5");
    //    exit; 
    //}
    
   $isSuccess = insertNewproduct_attr(               
        $product_attr_id, $product_id, $attr_name, $product_stock, $sale 
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
        <a href="product_attr_insert_form.php">กลับหน้าinsert new customer</a> 
    </body>
</html>
