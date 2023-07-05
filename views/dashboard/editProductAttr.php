<?php

error_reporting(E_ERROR | E_PARSE);

require_once("../../model/product_attr/output/product_attr_function.php");

session_start();

if ($_SESSION['user_status'] != "admin") {
    header("Location: http://localhost/shopa");
    exit();
}

$attrName = "";
$inStock = "";
$cat_id = "";

if (isset($_GET["product_attr"])) {
    $attrId = intval($_GET["product_attr"]);
    $result = getproduct_attrByproduct_attr_id($attrId);
    $attrName = $result[0]["attr_name"];
    $inStock = $result[0]["product_stock"];
}

if (isset($_GET["cat_id"])) {
    $cat_id = $_GET["cat_id"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard : Shopa Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Shopa</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>

    <div id="layoutSidenav">

        <?php include('sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Product Attribute</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Shopa</li>
                    </ol>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Insert Form
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>Data</th>
                                        <th>Input</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;">
                                    <!-- Form -->
                                    <form name="myForm" action="../../controller/restock.php" onsubmit="return validateForm()" method="post">
                                        <tr>
                                            <td>ชื่อ คุณสมบัติพิเศษ</td>
                                            <td><input name="attr_name" value="<?php echo $attrName ?>" type="text" id="typeText" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td>จำนวนสินค้าในสต็อค</td>
                                            <td>
                                                <input name="attr_stock" type="number" id="typeNumber" class="form-control" value="<?php echo $inStock ?>" step="1" min="0" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button style="width:100%; margin-top:10px;" name="submit" type="submit" class="btn btn-primary">SUBMIT</button>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="attrid" value="<?php echo $attrId ?>">
                                        <input type="hidden" name="catid" value="<?php echo $cat_id ?>">
                                    </form>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Shopa 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- form validation -->
    <script>
        function validateForm() {
            let name = document.forms["myForm"]["attr_name"].value;
            let instock = document.forms["myForm"]["attr_stock"].value;

            if (name == "") {
                alert("Name must be filled out");
                return false;
            } else if (instock == "") {
                alert("Product in stock must be filled out");
                return false;
            }

        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>