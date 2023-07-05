<div class="topWeb">
    <nav class="navbar navbar-expand-md" aria-label="Fourth navbar example">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mx-3" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="productView.php">All Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="productView.php?cat_id=best">Best Seller</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="productView.php?cat_id=1">Food</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=2">Electronic</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=3">Fashion</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=4">Enterainment</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=5">Pet</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=6">Automotive</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=7">Commodity</a></li>
                            <li><a class="dropdown-item" href="productView.php?cat_id=8">Etc</a></li>
                        </ul>
                    </li>

                    <?php
                    if ($_SESSION['isLogIn'] == '1') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link " href="orderView.php">Orders</a>
                        </li>

                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link " href="contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse mx-3" id="navbarsExample04">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">

                    <?php if ($_SESSION["user_status"] == "admin") { ?>

                        <li class="nav-item">
                            <a class="nav-link " href="views/dashboard/dashboard.php">Admin </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="controller/logOutProcess.php">Log out</a>
                        </li>
                    <?php } else if ($_SESSION["user_status"] == "user") { ?>

                        <li class="nav-item">
                            <a class="nav-link " href="controller/logOutProcess.php">Log out</a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="nav-link " href="views/login.php">LogIn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="views/register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="controller/logOutProcess.php">Log out</a>
                        </li>
                    <?php } ?>


                </ul>
            </div>
        </div>
    </nav>

    <form action="http://localhost/shopa/searchView.php" method="get">
        <header class="py-3 mb-4 container">
            <div class="row mx-5">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                    <img src="asset/1.png" alt="logo" height="50" class="mx-3">
                    <span class="fs-2">Shopa</span>
                </div>
                <div class="col-8 col-sm-8 col-md-6 col-lg-6 mt-1">
                    <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                </div>
                <div class="col-4 col-sm-2 col-md-1 col-lg-1 mt-1 ">
                    <button type="submit" class="btn btn-warning">search</button>
                </div>
                <div class="col-4 col-sm-2 col-md-2 col-lg-2 mt-1 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal" id="cart">
                    <div>
                        <i class="fa-solid fa-cart-shopping fa-xl"></i>

                        <?php
                        //Product in cart

                        if ($_SESSION["cart"] == "") {
                            echo "<p id='cart_num'>" . "0" . "</p>";
                        } else {
                            $cart = $_SESSION["cart"];
                            echo "<p id='cart_num'>" . count($cart) . "</p>";
                        }
                        ?>

                    </div>

                </div>
            </div>
        </header>
    </form>

</div>