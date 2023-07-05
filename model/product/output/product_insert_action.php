<?php
    require_once("product_function.php");
    session_start();

    
    
$product_id      =   trim($_POST['product_id']);
$cat_id      =   trim($_POST['cat_id']);
$product_name      =   trim($_POST['product_name']);
$detail      =   trim($_POST['detail']);
$unit_price      =   trim($_POST['unit_price']);
$img1      =   trim($_POST['img1']);
$img2      =   trim($_POST['img2']);
$img3      =   trim($_POST['img3']);
$img4      =   trim($_POST['img4']);
    
    $submit      =  $_POST['submit'];
    
    
$_SESSION["product_id"]      =  $product_id        ;
$_SESSION["cat_id"]      =  $cat_id        ;
$_SESSION["product_name"]      =  $product_name        ;
$_SESSION["detail"]      =  $detail        ;
$_SESSION["unit_price"]      =  $unit_price        ;
$_SESSION["img1"]      =  $img1        ;
$_SESSION["img2"]      =  $img2        ;
$_SESSION["img3"]      =  $img3        ;
$_SESSION["img4"]      =  $img4        ;
    
    if(!isset($submit))
    {
        header("location:product_insert_form.php");
    }


    
if($product_id == "")
            {
                header("location:product_insert_form.php?return=0");
                exit;
            }
if($cat_id == "")
            {
                header("location:product_insert_form.php?return=1");
                exit;
            }
if($product_name == "")
            {
                header("location:product_insert_form.php?return=2");
                exit;
            }
if($detail == "")
            {
                header("location:product_insert_form.php?return=3");
                exit;
            }
if($unit_price == "")
            {
                header("location:product_insert_form.php?return=4");
                exit;
            }
if($img1 == "")
            {
                header("location:product_insert_form.php?return=5");
                exit;
            }
if($img2 == "")
            {
                header("location:product_insert_form.php?return=6");
                exit;
            }
if($img3 == "")
            {
                header("location:product_insert_form.php?return=7");
                exit;
            }
if($img4 == "")
            {
                header("location:product_insert_form.php?return=8");
                exit;
            }

    
   // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //    header("location:insert_form.php?return=5");
    //    exit; 
    //}
    
   $isSuccess = insertNewproduct(               
        $product_id, $cat_id, $product_name, $detail, $unit_price, $img1, $img2, $img3, $img4 
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
        <a href="product_insert_form.php">กลับหน้าinsert new customer</a> 
    </body>
</html>
