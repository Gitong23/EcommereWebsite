<?php
    error_reporting(E_ERROR | E_PARSE);
    require_once('../model/user/output/user_function.php');
    session_start();
    $formOk=true;
    $return = "";

    if(isset($_POST['name'])){

        $_SESSION['name'] = $_POST['name'];
        $name = trim($_POST['name']);

        if($name == "")
        {
            $return =$return."name=1";
            $formOk = false;
        }
        else if(strlen($name) < 3)
        {
            $return =$return."name=2";
            $formOk = false;
        }
        else if(count(searchuser($name, 'username')) > 0)
        {
            $return =$return."name=3";
            $formOk = false;
        }
        else
        {
            $return =$return."name=0";
        }
    }

    if(isset($_POST['email'])){

        $_SESSION['email'] = $_POST['email'];
        $email = trim($_POST['email']);
        
        if($email == "")
        {
            $return =$return."&email=1";
            $formOk = false;
        }
        else if(count(searchuser($email, 'email')) > 0)
        {
            $return =$return."&email=3";
            $formOk = false;
        }
        else
        {
            $return =$return."&email=0";
        }
    }

    if(isset($_POST['password'])){
        $password = trim($_POST['password']);

        if($password == "")
        {
            $return = $return."&pass=1";
            $formOk = false;
        }
        else if(strlen($password) < 4)
        {
            $return = $return."&pass=2";
            $formOk = false;
        }
        else
        {
            if(isset($_POST['repassword']))
            {
                $repassword = trim($_POST['repassword']);

                if(strcmp($password, $repassword) == 0)
                {
                    $return = $return."&pass=0";
                }
                else
                {
                    $return = $return."&pass=4";
                    $formOk = false;
                }
            }
        }
    }

    // Form validation
    if($formOk)
    {
        // $pass_hash = hash('sha512',$password);
        if( insertNewuser(0, $name, hash('sha512',$password), $email, 'user') )
        {
            session_unset();
            session_destroy();
            header("Location: ../views/login.php?regis=success");
            exit();
        }
    }
    else
    {
        header("Location: ../views/register.php?".$return);
        exit();
    }

    
?>