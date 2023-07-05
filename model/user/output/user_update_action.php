<?php

    require_once("user_function.php");
    session_start();

    
$user_id      =   trim($_POST['user_id']);
$username      =   trim($_POST['username']);
$password      =   trim($_POST['password']);
$email      =   trim($_POST['email']);
$user_status      =   trim($_POST['user_status']);
    
    $submit      =   $_POST['submit'];
    
    
$_SESSION["user_id "]      =  $user_id        ;
$_SESSION["username "]      =  $username        ;
$_SESSION["password "]      =  $password        ;
$_SESSION["email "]      =  $email        ;
$_SESSION["user_status "]      =  $user_status        ;
    
   
    if(!isset($submit))
    {
        header("location:user_insert_form.php");
    }
    
    
    
if($user_id == "")
            {
                header("location:user_insert_form.php?action=edit&return=0");
                exit;
            }
if($username == "")
            {
                header("location:user_insert_form.php?action=edit&return=1");
                exit;
            }
if($password == "")
            {
                header("location:user_insert_form.php?action=edit&return=2");
                exit;
            }
if($email == "")
            {
                header("location:user_insert_form.php?action=edit&return=3");
                exit;
            }
if($user_status == "")
            {
                header("location:user_insert_form.php?action=edit&return=4");
                exit;
            }
    
  /*  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:insert_form.php?return=5");
        exit; 
    }
    */
   $isSuccess = updateuser(
                               
        $user_id, $username, $password, $email, $user_status 
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
        <a href="user_insert_form.php">กลับหน้าinsert new user</a> 
    </body>
</html>
