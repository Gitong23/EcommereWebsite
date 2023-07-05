<?php
    error_reporting(E_ERROR | E_PARSE);
    session_start();
    $formOk = true;
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopa:Register</title>

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">


    <!-- icon from font font-awesome -->
    <script src="https://kit.fontawesome.com/e2552fe58e.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        .warning{
            color : red;
        }
        .success{
            margin-left: auto;
            margin-right: auto;
            color : lightgreen;
            text-align: center;
        }
    </style>

    <script>

        $( document ).ready(function() {
            $("#back").click(function(e){
                e.preventDefault();
                window.location.replace("login.php");
            });
        });

    </script>
    
</head>

<body>

    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                        <!-- form start -->
                        <form  name="registerForm" action="../controller/registerNewUser.php" method="post" class="mx-1 mx-md-4">

                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <label class="form-label" for="form3Example1c">Your Username</label>
                                    <?php
                                        if(isset($_GET["name"]))
                                        {
                                            if($_GET["name"] == "1")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Please input your name</label><div>";
                                            }
                                            if($_GET["name"] == "2")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Username must have more than 3 charecter</label><div>";
                                            }
                                            if($_GET["name"] == "3")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* This username already used !!</label><div>";
                                            }
                                        }
                                    ?>          
                                    <input type="text" name="name" id="name" value="<?php echo $_SESSION['name']; ?>" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="d-flex flex-row align-items-center mb-4"> 
                                <div class="form-outline flex-fill mb-0">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <label class="form-label" for="form3Example3c">Your Email</label>
                                    <?php
                                        if(isset($_GET["email"]))
                                        {
                                            if($_GET["email"] == "1")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Please input your email</label><div>";
                                            }
                                            if($_GET["email"] == "2")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Email's format invalid</label><div>";
                                            }
                                            if($_GET["email"] == "3")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* This email already used !!</label><div>";
                                            }
                                        }
                                    ?> 
                                    <input type="email" name="email" id="form3Example3c" value="<?php echo $_SESSION['email']; ?>" class="form-control" />
                                </div>
                            </div>
                            

                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <label class="form-label" for="form3Example4c">Password</label>
                                    <?php
                                        if(isset($_GET["pass"]))
                                        {
                                            if($_GET["pass"] == "1")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Please input your password</label><div>";
                                            }
                                            if($_GET["pass"] == "2")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Password must have more than 4 charecter</label><div>";
                                            }
                                            if($_GET["pass"] == "4")
                                            {
                                                echo "<div><label class='form-label warning' for='form3Example1c'>* Repassword not same password</label><div>";
                                            }
                                        }
                                    ?>
                                    <input type="password" name="password" id="form3Example4c" class="form-control" />
                                </div>
                            </div>
                            

                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                    <input type="password" name="repassword" id="form3Example4cd" class="form-control" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <button type="submit" class="btn btn-primary btn-lg mx-2">Register</button>
                                <button type="button" class="btn btn-secondary btn-lg mx-2" id="back">Back</button>
                            </div>
                            
                        </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>