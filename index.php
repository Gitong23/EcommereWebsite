<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

// if ($_SESSION['user_id'] != "") {
//     echo $_SESSION['user_id'];
// }

// if ($_SESSION['username'] != "") {
//     echo $_SESSION['username'];
// }

// if ($_SESSION['user_status'] != "") {
//     echo $_SESSION['user_status'];
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>

    <!-- CDN Bootstarp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200&family=Roboto:wght@100;300&display=swap" rel="stylesheet">

    <!-- font-awesome -->
    <script src="https://kit.fontawesome.com/e2552fe58e.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: rgb(235, 235, 235);
        }

        .topWeb {
            background: rgb(131, 58, 180);
            background: linear-gradient(59deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
            font-family: 'Roboto', sans-serif;
            font-weight: bolder;
            color: white;
        }

        .navbar-nav .nav-link {
            color: white;
            transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            box-shadow: inset 100px 0 0 0 #f3f70f;
            color: rgb(17, 17, 17);
        }

        #cart {

            margin-left: 50px;
            padding-top: 10px;
            width: 50px;
            transition: 0.3s;
        }

        #cart:hover {
            background-color: orange;
            border-radius: 30px;
            cursor: pointer;
        }

        .cat_header {
            background-color: rgb(255, 255, 255);
            border-radius: 25px;
            box-shadow: 5px 10px #888888;
        }

        .category {
            padding-top: 30px;
            background-color: rgb(255, 255, 255);
            border: 1px solid rgb(230, 230, 230);
            transition: 0.5s;

        }

        .category:hover {
            box-shadow: 5px 5px #888888;
            background-color: orange;
            transform: scale(1.1);
        }

        .bottomWeb {
            font-weight: 400;
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 0;
            padding-bottom: 10px;
            background: rgb(195, 77, 34);
            background: linear-gradient(34deg, rgba(195, 77, 34, 1) 0%, rgba(253, 121, 45, 0.9248949579831933) 42%);
        }
    </style>
</head>

<body>

    <?php include("views/navbar.php") ?>

    <div class="container">

        <div id="carouselExampleIndicators" class="carousel slide ">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner mt-3">
                <div class="carousel-item active">
                    <img src="asset/slide1.jpg" height="400" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="asset/slide2.jpg" height="400" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="asset/slide3.jpg" height="400" class="d-block w-100" alt="...">
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row text-center mt-3 py-2 cat_header">
            <div class="col">
                <h1>Category</h1>
            </div>
        </div>

        <div class="row mt-4 text-center">

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="1">
                <img class=" rounded-circle mb-4" src="asset/cat1.jpg" alt="cat1" width="140" height="140">
                <h3 class="fw-normal">Food</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="2">
                <img class=" rounded-circle mb-4" src="asset/cat2.jpg" alt="cat2" width="140" height="140">
                <h3 class="fw-normal">Electronic</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="3">
                <img class=" rounded-circle mb-4" src="asset/cat3.jpg" alt="cat3" width="140" height="140">
                <h3 class="fw-normal">Fashion</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="4">
                <img class=" rounded-circle mb-4" src="asset/cat4.jpg" alt="cat4" width="140" height="140">
                <h3 class="fw-normal">Entertainment</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="5">
                <img class=" rounded-circle mb-4" src="asset/cat5.jpg" alt="cat5" width="140" height="140">
                <h3 class="fw-normal">Pet</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="6">
                <img class=" rounded-circle mb-4" src="asset/cat6.jpg" alt="cat6" width="140" height="140">
                <h3 class="fw-normal">Automotive</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="7">
                <img class=" rounded-circle mb-4" src="asset/cat7.jpg" alt="cat7" width="140" height="140">
                <h3 class="fw-normal">Commodity</h3>
            </div>

            <div class="category col-sm-6 col-md-4 col-lg-3 " cat="8">
                <img class=" rounded-circle mb-4" src="asset/cat8.png" alt="cat8" width="140" height="140">
                <h3 class="fw-normal">Etc.</h3>
            </div>

        </div>
    </div>

    <?php
    include("views/footer.php");
    include("views/modal.php");
    ?>

    <script>
        $(".category").click(function(e) {
            e.preventDefault();
            let cat_id = $(this).attr("cat");
            let url = 'http://localhost/shopa/productView.php?cat_id=' + cat_id;
            $(location).prop('href', url);
        });
    </script>

    <!-- CDN Bootstarp JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>