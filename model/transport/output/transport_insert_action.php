<?php
    require_once("transport_function.php");
    session_start();

    
    
$trans_id      =   trim($_POST['trans_id']);
$trans_name      =   trim($_POST['trans_name']);
$trans_price      =   trim($_POST['trans_price']);
    
    $submit      =  $_POST['submit'];
    
    
$_SESSION["trans_id"]      =  $trans_id        ;
$_SESSION["trans_name"]      =  $trans_name        ;
$_SESSION["trans_price"]      =  $trans_price        ;
    
    if(!isset($submit))
    {
        header("location:transport_insert_form.php");
    }


    
if($trans_id == "")
            {
                header("location:transport_insert_form.php?return=0");
                exit;
            }
if($trans_name == "")
            {
                header("location:transport_insert_form.php?return=1");
                exit;
            }
if($trans_price == "")
            {
                header("location:transport_insert_form.php?return=2");
                exit;
            }

    
   // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //    header("location:insert_form.php?return=5");
    //    exit; 
    //}
    
   $isSuccess = insertNewtransport(               
        $trans_id, $trans_name, $trans_price 
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
        <a href="transport_insert_form.php">กลับหน้าinsert new customer</a> 
    </body>
</html>
