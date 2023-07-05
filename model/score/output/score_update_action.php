<?php

    require_once("score_function.php");
    session_start();

    
$score_id      =   trim($_POST['score_id']);
$user_id      =   trim($_POST['user_id']);
$product_id      =   trim($_POST['product_id']);
    
    $submit      =   $_POST['submit'];
    
    
$_SESSION["score_id "]      =  $score_id        ;
$_SESSION["user_id "]      =  $user_id        ;
$_SESSION["product_id "]      =  $product_id        ;
    
   
    if(!isset($submit))
    {
        header("location:score_insert_form.php");
    }
    
    
    
if($score_id == "")
            {
                header("location:score_insert_form.php?action=edit&return=0");
                exit;
            }
if($user_id == "")
            {
                header("location:score_insert_form.php?action=edit&return=1");
                exit;
            }
if($product_id == "")
            {
                header("location:score_insert_form.php?action=edit&return=2");
                exit;
            }
    
  /*  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:insert_form.php?return=5");
        exit; 
    }
    */
   $isSuccess = updatescore(
                               
        $score_id, $user_id, $product_id 
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
        <a href="score_insert_form.php">กลับหน้าinsert new score</a> 
    </body>
</html>
