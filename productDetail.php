<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

$product_id = $_GET["product_id"];
$user_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>

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

        .product_slide {
            height: 400px;
            background-color: red;
        }

        .img-container {
            background-color: black;
        }

        img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
        }

        .mySlides {
            display: none;
        }

        .slideshow-container {
            /* max-width: 100%; */
            position: relative;
            margin: auto;
        }

        .slideshow-container .mySlides img {
            height: 400px;
            aspect-ratio: 4/3;
        }

        .dot {
            height: 50px;
            width: 50px;
            margin: 0 2px;
            background-color: #bbb;
            display: inline-block;
            border-radius: 100px;
            transition: background-color 0.6s ease;
            overflow: hidden;
        }

        .dot img {
            height: 60px;
            aspect-ratio: 4/3;
        }

        /* Fading animation */
        .fade-in-image {
            animation: fadeIn 1.5s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .showDetail-container {
            padding-top: 20px;
            box-shadow: 5px 8px #888888;
            background-color: rgb(255, 255, 255);
        }

        .btn_attr {
            border-radius: 10px;
            padding: 5px;
            background-color: rgb(255, 255, 255);
            font-size: large;
            color: orange;
            border: 2px solid orange;
            transition: 0.5s;
        }

        .btn_attr:hover {
            background-color: #f3f70f;
        }

        #add_cart {
            padding: 10px;
            font-size: larger;
        }

        #buy_now {
            padding: 10px;
            font-size: larger;
        }

        .rating_product {
            width: fit-content;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid orange;
        }

        .addComment-container {
            height: fit-content;
            padding-top: 30px;
            padding-left: 50px;
            padding-right: 50px;
            padding-bottom: 20px;
            border-radius: 10px;
            box-shadow: 5px 8px #888888;
            background: rgb(240, 150, 80);
        }

        .comment-container {
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 5px 8px #888888;
        }
    </style>
</head>

<body>

    <?php include("views/navbar.php") ?>

    <input type="hidden" id="user_id" name="uset_id" value="<?php echo $user_id ?>">
    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>">
    <!-- isLogIn -->
    <input type="hidden" id="logIn" name="logIn" value="<?php
                                                        if ($_SESSION["isLogIn"] == 1) {
                                                            echo 1;
                                                        } else {
                                                            echo 0;
                                                        }
                                                        ?>">

    <div class="container showDetail-container mt-2">
        <div class="row row-cols-1 justify-content-center" id="insert">

        </div>
    </div>

    <div class="container addComment-container mt-4">
        <div class="row row-cols-1 justify-content-center text-center" id="addComment">
            <div class="form-outline">
                <h2 style="color:white;">เขียนรีวิวสินค้า</h2>
                <textarea class="form-control mt-3" rows="6" placeholder="พิมพ์เพื่อบอกความประทับใจในสินค้า สิคะ" id="textComment"></textarea>
                <button type="button" class="btn btn-warning mt-3" style="width: 20%; padding: 5px; border-radius: 20px;" onclick="add_comment();">
                    <h6>SUBMIT</h6>
                </button>
            </div>
        </div>
    </div>

    <div class="container comment-container mt-4" id="comment-container">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <h1 id="product_header" style="padding-top: 10px;">Review Product</h1>

            </div>
            <hr style="width: 90%;">
        </div>

        <div class="row  justify-content-center pt-2 pd-2">
            <div class="col-sm-12 col-md-10 col-lg-10 ">
                <p style="font-size: large; text-align:center;">Not have any review yet !</p>
                <p style="font-size: large; text-align:center;">Be first comment to review ?</p>
            </div>
        </div>

    </div>


    <?php
    include("views/footer.php");
    include("views/modal.php");
    ?>

    <script>
        var slideIndex = 1;
        let selectAttr = -1;
        let stock = 0;

        let selectProductName = "";
        let selectAttrName = "";
        let selectUnitPrice = "";

        loadData();
        loadComment();

        async function loadComment() {

            let product_id = $("#product_id").val();
            let url = "http://localhost/shopa/controller/getCommentProduct.php?product_id=" + product_id;

            $.getJSON(url, function(data) {
                let template = `
                    <div class="row justify-content-center text-center">
                        <div class="col-12">
                            <h1 id="product_header" style="padding-top: 10px;">Review Product</h1>

                        </div>
                        <hr style="width: 90%;">
                    </div>
            `;
                for (let i = 0; i < data.length; i++) {
                    let s = `
                    <div class="row  justify-content-center pt-2 pd-2">
                        <div class="col-sm-12 col-md-1 col-lg-1">
                            <img src="asset/person.png" alt="twbs" width="50" height="50" class="rounded-circle flex-shrink-0">
                            <p style="text-align: center;">{name}</p>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10 ">
                            <p style="font-size: large;">{content}</p>
                        </div>
                        <hr style="width: 90%; ">
                    </div> 
                    `;

                    s = s.replaceAll('{name}', data[i].username);
                    s = s.replaceAll('{content}', data[i].content);
                    template += s;
                }

                $("#comment-container").html(template);
            });

        }


        function add_comment() {

            if (validateComment()) {

                let user_id = $("#user_id").val();
                let content = $("#textComment").val();
                let product = $("#product_id").val();

                var addComment = {
                    user_id: parseInt(user_id),
                    product_id: parseInt(product),
                    content: content
                };

                var options = {
                    url: "http://localhost/shopa/controller/addNewComment.php",
                    dataType: "text",
                    type: "POST",
                    data: {
                        dataJson: JSON.stringify(addComment)
                    },
                    success: function(result, status, xhr) {
                        alert(result);
                        $("#textComment").val("");
                        loadComment();
                    },
                };

                $.ajax(options);

            }
        }

        function validateComment() {
            let content = $("#textComment").val();
            let isLogin = parseInt($("#logIn").val());

            if (parseInt(isLogin) == 0) {
                alert("โปรดเข้าสู่ระบบ");
                return false;
            } else if (content == "") {
                alert("Please add some comment");
                return false;
            } else {
                return true;
            }
        }


        function add_score() {
            if (validateScore()) {

                let user_id = $("#user_id").val();
                let score = $("#score").val();
                let product = $("#product_id").val();
                let total_score = $("#total_score").val();
                let review = $("#review").val();

                var addSore = {
                    user_id: parseInt(user_id),
                    product: parseInt(product),
                    score: parseInt(score),
                    total: parseInt(total_score),
                    review: parseInt(review)
                };

                var options = {
                    url: "http://localhost/shopa/controller/addScore.php",
                    dataType: "text",
                    type: "POST",
                    data: {
                        dataJson: JSON.stringify(addSore)
                    },
                    success: function(result, status, xhr) {
                        alert(result);
                        loadData();
                    },

                };

                $.ajax(options);


            }
        }

        function validateScore() {
            let isLogin = parseInt($("#logIn").val());
            if (parseInt(isLogin) == 0) {
                alert("โปรดเข้าสู่ระบบ");
                return false;
            } else {
                return true;
            }


        }

        function add_cart() {
            if (validateCart()) {

                var orderDetail = {
                    attrId: selectAttr,
                    qty: parseInt($("#typeNumber").val()),
                    product_name: selectProductName,
                    attr_name: selectAttrName,
                    unit_price: selectUnitPrice
                };

                var options = {
                    url: "http://localhost/shopa/controller/addToCart.php",
                    dataType: "text",
                    type: "POST",
                    data: {
                        dataJson: JSON.stringify(orderDetail)
                    },
                    success: function(result, status, xhr) {
                        // alert(result);
                        //call back after post success
                        alert("Item has been added");
                        $(location).prop('href', 'http://localhost/shopa/productView.php');
                    },

                };

                $.ajax(options);

            }
        }


        function validateCart() {
            let isLogin = parseInt($("#logIn").val());
            let qty = parseInt($("#typeNumber").val());

            if (parseInt(isLogin) == 0) {
                alert("โปรดเข้าสู่ระบบ");
                return false;
            } else if (selectAttr == -1) {
                alert("โปรดเลือกคุณสมบัติสินค้า");
                return false;
            } else if (qty <= 0) {
                alert("โปรดเลือกจำนวนสินค้าให้ถูกต้อง");
                return false;
            } else if (stock - qty < 0) {
                alert("ขอโทษค่ะ สินค้ามีไม่พอความต้องการ");
                return false;
            } else {
                return true;
            }
        }

        function select_product_attr(select_attr, idx) {
            let attrLength = $('.btn_attr').length;
            let x = $('.btn_attr')[parseInt(idx)];

            if (parseInt(select_attr) == selectAttr) {
                x.style.backgroundColor = "white";
                x.style.color = "orange";
                selectAttr = -1;

                let s = `สิ้นค้า คงเหลือ: 0 ชิ้น`;
                $("#stock").html("");
                $("#stock").html(s);
                stock = 0;
                selectProductName = "";
                selectAttrName = "";
                selectUnitPrice = "";

                return;
            }

            for (let i = 0; i < attrLength; i++) {
                $('.btn_attr')[i].style.backgroundColor = "white";
                $('.btn_attr')[i].style.color = "orange";
            }

            x.style.backgroundColor = "red";
            x.style.color = "white";
            selectAttr = parseInt(select_attr);
            getInStock(selectAttr);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        async function getInStock(product_attr_id) {
            let url = "http://localhost/shopa/controller/getProductStock.php?attr_id=" + product_attr_id;
            const response = await fetch(url);
            const data = await response.json();

            // console.log(data);
            let s = `สิ้นค้า คงเหลือ: ${data[0].stock} ชิ้น`;
            $("#stock").html("");
            $("#stock").html(s);
            stock = parseInt(data[0].stock);
            selectProductName = data[0].product_name;
            selectAttrName = data[0].attr_name;
            selectUnitPrice = parseInt(data[0].unit_price);
        }

        async function loadData() {

            let product_id = $("#product_id").val();
            let url = "http://localhost/shopa/controller/getProductDetail.php?product_id=" + product_id;
            const response = await fetch(url);
            const data = await response.json();
            let template1 = `
            
            <div class="col col-12 col-md-6 mb-5">

                <div class="slideshow-container mb-2">
                    <div class="mySlides fade-in-image"><img src="{img1}" alt="x"></div>
                    <div class="mySlides fade-in-image"><img src="{img2}" alt="x"></div>
                    <div class="mySlides fade-in-image"><img src="{img3}" alt="x"></div>
                    <div class="mySlides fade-in-image"><img src="{img4}" alt="x"></div>
                </div>

                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"><img src="{img1}" alt="x"></span>
                    <span class="dot" onclick="currentSlide(2)"><img src="{img2}" alt="x"></span>
                    <span class="dot" onclick="currentSlide(3)"><img src="{img3}" alt="x"></span>
                    <span class="dot" onclick="currentSlide(4)"><img src="{img4}" alt="x"></span>
                </div>

                </div>

                <div class="col col-12 col-md-6 mb-5 product_detail">
                    <h3 class="mb-2">{product_name}</h3>
                    <span style="border-right: 1px solid #888888; padding-right:5px;">คะแนนรีวิว <h4 style="display:inline; color:red;">{score}</h4> คะแนน</span>
                <span>ขายไปแล้ว {sale} ชิ้น</span>

                <div class="showPrice mt-3" style="color: red;">
                    <h2>{unit_price} ฿</h2>
                </div>

                <div class="showAttr mt-4">
                    <span style="font-size: large;">คุณสมบัติ: </span>     
            `;

            let scoreReview = "";
            if (parseFloat(data[0].num_user_review) == 0) {
                scoreReview = 0;
            } else {
                scoreReview = Math.round((parseFloat(data[0].score_total) / parseFloat(data[0].num_user_review)) * 100) / 100;
            }

            template1 = template1.replaceAll('{img1}', data[0].img1);
            template1 = template1.replaceAll('{img2}', data[0].img2);
            template1 = template1.replaceAll('{img3}', data[0].img3);
            template1 = template1.replaceAll('{img4}', data[0].img4);
            template1 = template1.replaceAll('{product_name}', data[0].product_name);
            template1 = template1.replaceAll('{sale}', data[0].total_sale);
            template1 = template1.replaceAll('{score}', scoreReview);
            template1 = template1.replaceAll('{unit_price}', data[0].unit_price);

            let template2 = "";
            for (let i = 0; i < data.length; i++) {
                let t = `<button class="btn_attr me-1" onclick="select_product_attr({attrId}, ${i})" ">{attr}</button>`;
                template2 += t.replaceAll('{attr}', data[i].attr_name);
                template2 = template2.replaceAll('{attrId}', data[i].product_attr_id);
            }

            let template3 = `
                </div>

                <div class="stock mt-3">
                    <span style="font-size: large; margin-top: 20px;" id='stock' >สิ้นค้า คงเหลือ: 0 ชิ้น</span>
                </div>

                <div class="form-outline mt-4">
                    <span style="font-size: large;">จำนวน: </span>
                    <input style="width: 100px; display:inline-block;" type="number" id="typeNumber" class="form-control" value="0" min="0" step="1" />
                </div>

                <button style="width:350px;" class="btn btn-outline-warning mt-4 " id="add_cart" onclick="add_cart()"><i class="fa-sharp fa-solid fa-cart-shopping"></i> เพิ่มไปยังรถเข็น</button>

                <hr>

                <div class="rating_product ms-auto">
                    <input id="score" style="width: 50px; display:inline;" type="number" class="form-control " value="5" min="0" max="5" step="1" />
                    <button class="btn btn-outline-warning"  onclick="add_score();"> ให้คะแนนสินค้า</button>
                </div>

                </div>

                <input type="hidden" id="total_score" name="total_score" value="{total_score}">
                <input type="hidden" id="review" name="review" value="{review}">
            `;

            template3 = template3.replaceAll('{total_score}', data[0].score_total);
            template3 = template3.replaceAll('{review}', data[0].num_user_review);

            $("#insert").html("");
            $("#insert").html(template1 + template2 + template3);

            showSlides(slideIndex);
        }
    </script>

    <!-- CDN Bootstarp JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>