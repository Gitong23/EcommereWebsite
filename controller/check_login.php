<?php

error_reporting(E_ERROR | E_PARSE);
require_once('../model/user/output/user_function.php');
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $result = searchuser($email, 'email');

    if (count($result) == 1) {
        $pass_hash = hash('sha512', $password);

        if (strcmp($pass_hash, $result[0]['password']) == 0) {
            //correct password
            $_SESSION['user_id'] = $result[0]['user_id'];
            $_SESSION['username'] = $result[0]['username'];
            $_SESSION['user_status'] = $result[0]['user_status'];
            $_SESSION['isLogIn'] = 1;
            header("Location: ../index.php");
            exit();
        } else {
            //wrong password
            header("Location: ../views/login.php?return=3");
            exit();
        }
    } else {
        header("Location: ../views/login.php?return=2"); //wrong email
        exit();
    }
}
