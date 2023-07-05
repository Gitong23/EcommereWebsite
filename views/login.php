<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopa</title>

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

    <style>
        .warning {
            color: red;
        }

        .login_button {
            background: rgb(195, 77, 34);
            background: linear-gradient(183deg, rgba(195, 77, 34, 1) 0%, rgba(253, 121, 45, 0.9248949579831933) 99%);
            color: white;
        }

        .login_button:hover {
            background: linear-gradient(0deg, rgba(195, 77, 34, 1) 0%, rgba(253, 121, 45, 0.9248949579831933) 99%);
            color: white;
        }
    </style>

    <!-- icon from font font-awesome -->
    <script src="https://kit.fontawesome.com/e2552fe58e.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body class="text-center">
    <main class="form-signin w-50 mx-auto mt-5">
        <form action="../controller/check_login.php" method="POST">
            <img class="mb-4" src="../asset/1.png" alt="" width="150" height="150">

            <?php
            if (isset($_GET['regis']) && ($_GET['regis'] == 'success')) {
                echo "<h1 class='h3 mb-3 fw-normal'>Register Successful!!!</h1>";
            }

            if (isset($_GET['return'])) {
                $return = $_GET['return'];

                if ($return == "2") {
                    echo "<h3 class='h3 mb-3 fw-normal warning'>Wrong Email!!</h3>";
                } else if ($return == "3") {
                    echo "<h3 class='h3 mb-3 fw-normal warning'>Wrong Password!!</h3>";
                }
            }
            ?>

            <h1 class="h3 mb-3 fw-normal">Please Log in</h1>
            <div class="form-floating">
                <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="">
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div>
                <a href="register.php" style="font-size: 18px">Register</a>
            </div>

            <button class="w-100 btn btn-lg mt-3 login_button" type="submit" name="submit">Log in</button>


            <p class="mt-5 mb-3 text-body-secondary">© Shopa 2023</p>
        </form>
    </main>


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>