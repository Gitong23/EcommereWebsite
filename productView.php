<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

if (isset($_GET["cat_id"])) {
    $cat_id = $_GET['cat_id'];
} else {
    $cat_id = "showall";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>

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

        .showProduct {
            min-height: 500px;
        }

        .product_header {
            background-color: rgb(255, 255, 255);
            border-radius: 25px;
            box-shadow: 5px 10px #888888;
        }

        .card {
            text-align: center;
            border-radius: 0px;
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 2px;
            margin-right: 2px;
            margin-top: 10px;
            background-color: white;
            transition: 0.5s;
            min-height: 300px;
            /* max-height: 400px;
            overflow: hidden; */
        }

        .card-body {
            background-color: white;
            padding: 0;
        }

        .card:hover {
            box-shadow: 5px 5px 5px 5px orange;
            transform: translateY(-10px);
            background-color: orange;
            cursor: pointer;
            border: 0px
        }

        .card img {
            height: 200px;
        }

        .cardDetail {
            text-align: center;
            padding-top: 5px;
            padding-bottom: 0px;
            color: white;
        }
    </style>
</head>

<body>

    <?php include("views/navbar.php") ?>
    <input type="hidden" id="cat_id" name="cat_id" value="<?php echo $cat_id ?>">
    <div class="container showProduct" id="showProduct">


    </div>



    <?php
    include("views/footer.php");
    include("views/modal.php");
    ?>

    <script>
        $(document).ready(function() {
            loadData();
        });

        function toDetail(product_id) {
            let url = 'http://localhost/shopa/productDetail.php?product_id=' + product_id;
            $(location).prop('href', url);
        }

        function loadData() {
            let catId = $("#cat_id").val();
            let url = "http://localhost/shopa/controller/showProduct.php?cat_id=" + catId;

            let result = "";

            $.getJSON(url, function(data) {
                let header = `
                    <div class="row text-center mt-3 py-2 product_header">
                        <div class="col">
                            <h1 id="product_header">{category}</h1>
                        </div>
                    </div> 
                `;

                header = header.replaceAll('{category}', (data[0].cat_name).toUpperCase());
                result += header;
                result += `<div class="row mt-5 justify-content-center">`;

                for (let i = 0; i < data.length; i++) {
                    let template = `
                    <div class="card col-sm-6 col-md-4 col-lg-2" product={product_id} onclick="toDetail({product_id})">
                        <img src="{img}" class="card-img-top" alt="product">
                        <div class="card-body">
                            <h5 class="card-text mt-2">{product_name}</h5>
                            <p style="text-align: center; color:red;">ราคา {unit_price} ฿</p>
                            <p style="text-align: center; color: rgb(255, 189, 37);">คะแนนรีวิว {score} คะแนน</p>
                            <p style="text-align: center; color: #888888;">ขายไปแล้ว {sale} ชิ้น</p>
                        </div>
                        <div class="cardDetail">
                            <p>คลิกเพื่อดู รายละเอียด</p>
                        </div>
                    </div>
                    `;

                    let scoreReview = "";
                    if (parseFloat(data[i].num_user_review) == 0) {
                        scoreReview = 0;
                    } else {
                        scoreReview = Math.round((parseFloat(data[i].score_total) / parseFloat(data[i].num_user_review)) * 100) / 100;
                    }

                    template = template.replaceAll('{img}', data[i].img1);
                    template = template.replaceAll('{product_id}', data[i].product_id);
                    template = template.replaceAll('{product_name}', data[i].product_name);
                    template = template.replaceAll('{unit_price}', data[i].unit_price);
                    template = template.replaceAll('{score}', scoreReview);
                    template = template.replaceAll('{sale}', data[i].total_sale);

                    result += template;
                }

                result += `</div>`;

                $("#showProduct").html(result);
            });
        }
    </script>

    <!-- CDN Bootstarp JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>