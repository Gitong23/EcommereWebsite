<?php

    require_once("order_detail_function.php");
    session_start();

    
$order_detail_id      =   trim($_POST['order_detail_id']);
$order_id      =   trim($_POST['order_id']);
$product_attr_id      =   trim($_POST['product_attr_id']);
$qty      =   trim($_POST['qty']);
    
    $submit      =   $_POST['submit'];
    
    
$_SESSION["order_detail_id "]      =  $order_detail_id        ;
$_SESSION["order_id "]      =  $order_id        ;
$_SESSION["product_attr_id "]      =  $product_attr_id        ;
$_SESSION["qty "]      =  $qty        ;
    
   
    if(!isset($submit))
    {
        header("location:order_detail_insert_form.php");
    }
    
    
    
if($order_detail_id == "")
            {
                header("location:order_detail_insert_form.php?action=edit&return=0");
                exit;
            }
if($order_id == "")
            {
                header("location:order_detail_insert_form.php?action=edit&return=1");
                exit;
            }
if($product_attr_id == "")
            {
                header("location:order_detail_insert_form.php?action=edit&return=2");
                exit;
            }
if($qty == "")
            {
                header("location:order_detail_insert_form.php?action=edit&return=3");
                exit;
            }
    
  /*  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:insert_form.php?return=5");
        exit; 
    }
    */
   $isSuccess = updateorder_detail(
                               
        $order_detail_id, $order_id, $product_attr_id, $qty 
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
        <h1><?php echo $isSuccess ? "แก้ไข สำเร็จ"  : "ล้มเหลว"; ?></h1>
        <br/>
        <a href="index.php">กลับหน้าหลัก</a>
        <br/>
        <a href="order_detail_insert_form.php">กลับหน้าinsert new order_detail</a> 
    </body>
</html>
