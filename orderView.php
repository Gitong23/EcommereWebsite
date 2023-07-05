<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

if ($_SESSION["user_id"] == "") {
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Views</title>

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

    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
        <div class="list-group" style="width: 50%;">


            <?php

            require_once("model/order/output/order_fuction.php");
            $user_id = intval($_SESSION["user_id"]);
            $order = getOrderViewByUserId($user_id);

            if (count($order) == 0) {
            ?>

                <a class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true" onclick="detailClick(0)">
                    <img src="asset/1.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 style="color:red;" class="mb-1"># ไม่พบ Order</h6>
                            <p class="mb-1 ">Order Status: N/A</p>
                            <p class="mb-1 ">Total Price: N/A</p>
                            <p class="mb-1 ">Shipping: N/A</p>
                            <p class="mb-0 opacity-75">Last Update: N/A</p>
                        </div>
                        <small class="opacity-20 text-nowrap">Click for information</small>
                    </div>
                </a>

            <?php
            } else {

                for ($i = 0; $i < count($order); $i++) {
                    echo "
                        <a class='list-group-item list-group-item-action d-flex gap-3 py-3' aria-current='true' onclick='detailClick(" . $i . ");'>
                        <img src='asset/1.png' alt='twbs' width='32' height='32' class='rounded-circle flex-shrink-0'>
                        <div class='d-flex gap-2 w-100 justify-content-between'>
                            <div>
                                <h6 style='color:red;' class='mb-1'># ORDER ID : " . $order[$i]["order_id"] . "</h6>
                                <p class='mb-1 '>Order Status: " . $order[$i]["status"] . "</p>
                                <p class='mb-1 '>Total Price: " . $order[$i]["total"] . "</p>
                                <p class='mb-1 '>Shipping: " . $order[$i]["trans_name"] . "</p>
                                <div class='toggleDiv' id='toggleDiv" . $i . "' order='" . $order[$i]["order_id"] . "'>
                                 
                                </div>
                                <p class='mb-0 opacity-75'>Last Update: " . $order[$i]["last_update"] . "</p>
                            </div>
                            <small class='opacity-20 text-nowrap'>Click for information</small>
                        </div>
                    </a>";
                }
            }
            ?>
        </div>
    </div>



    <?php
    include("views/footer.php");
    include("views/modal.php");
    ?>

    <!-- CDN Bootstarp JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        function detailClick(id) {
            let s = "#toggleDiv" + id;
            let order = $(s).attr('order');
            let url = "http://localhost/shopa/controller/getOrderList.php?order_id=" + order;

            $.getJSON(url, function(result) {
                let template = "<ol style='color:red;'>";
                for (let i = 0; i < result.length; i++) {
                    template += "<li>" + result[i].product_name + "\nจำนวน: " + result[i].qty + "  ชิ้น ราคา: " + result[i].price + " บาท </li>";
                }
                template += "</ol>"
                $(s).html(template);
                $(s).slideToggle();
            });
        }

        $(document).ready(function() {
            $(".toggleDiv").hide();
        });
    </script>
</body>

</html>