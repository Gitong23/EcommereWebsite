<?php

    require_once("comment_function.php");
    session_start();

    
$comment_id      =   trim($_POST['comment_id']);
$user_id      =   trim($_POST['user_id']);
$product_id      =   trim($_POST['product_id']);
$content      =   trim($_POST['content']);
    
    $submit      =   $_POST['submit'];
    
    
$_SESSION["comment_id "]      =  $comment_id        ;
$_SESSION["user_id "]      =  $user_id        ;
$_SESSION["product_id "]      =  $product_id        ;
$_SESSION["content "]      =  $content        ;
    
   
    if(!isset($submit))
    {
        header("location:comment_insert_form.php");
    }
    
    
    
if($comment_id == "")
            {
                header("location:comment_insert_form.php?action=edit&return=0");
                exit;
            }
if($user_id == "")
            {
                header("location:comment_insert_form.php?action=edit&return=1");
                exit;
            }
if($product_id == "")
            {
                header("location:comment_insert_form.php?action=edit&return=2");
                exit;
            }
if($content == "")
            {
                header("location:comment_insert_form.php?action=edit&return=3");
                exit;
            }
    
  /*  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:insert_form.php?return=5");
        exit; 
    }
    */
   $isSuccess = updatecomment(
                               
        $comment_id, $user_id, $product_id, $content 
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
        <a href="comment_insert_form.php">กลับหน้าinsert new comment</a> 
    </body>
</html>
