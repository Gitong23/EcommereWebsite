<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

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

    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="asset/company.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Contact Shopa</h1>
                <p class="lead">Email : ShopaShopaShopa@shop.com</p>
                <p class="lead">Tel : xxx-xxxxx-xxxx-x</p>
                <p class="lead">Facebook : ShopaShopaShopa</p>
                <p class="lead">Instragram : ShopaShopa55</p>
                <p class="lead">Tiktok : ShopaSho</p>
                <p class="lead">Address : 899/88 Abby Road Manchester England</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">Customer Service</button>
                </div>
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