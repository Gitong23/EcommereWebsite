<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

if ($_SESSION['user_status'] != "admin") {
    header("Location: http://localhost/shopa");
    exit();
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

    <!-- Side Menu -->
    <div id="layoutSidenav">

        <?php include('sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add New Product</h1>
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
                                <tbody>
                                    <!-- Form -->
                                    <form name="myForm" action="../../controller/addNewProduct.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                                        <tr>
                                            <td>Name</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="product_name" type="text" id="typeText" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td>
                                                <select name="category" class="form-select" aria-label="Default select example">
                                                    <option selected value="1">Food</option>
                                                    <option value="2">Electronic</option>
                                                    <option value="3">Fashion</option>
                                                    <option value="4">Entertainment</option>
                                                    <option value="5">Pet</option>
                                                    <option value="6">Automotive</option>
                                                    <option value="7">Commodity</option>
                                                    <option value="8">Etc</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Detail</td>
                                            <td>
                                                <div class="form-outline">
                                                    <textarea name="detail" class="form-control" id="textAreaExample1" rows="4"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Unit Price (Bath)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="unit_price" type="number" id="typeNumber" class="form-control" value="0.00" step="0.01" min="0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attribute No.1</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr_1" type="text" id="typeText" class="form-control" />
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>In Stock (Attr.1)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr1_stock" type="number" id="typeNumber" class="form-control" value="0" step="1" min="0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attribute No.2 (optional)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr_2" type="text" id="typeText" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>In Stock (Attr.2)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr2_stock" type="number" id="typeNumber" class="form-control" value="0" step="1" min="0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attribute No.3 (optional)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr_3" type="text" id="typeText" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>In Stock (Attr.3)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr3_stock" type="number" id="typeNumber" class="form-control" value="0" step="1" min="0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attribute No.4 (optional)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr_4" type="text" id="typeText" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>In Stock (Attr.4)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr4_stock" type="number" id="typeNumber" class="form-control" value="0" step="1" min="0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attribute No.5 (optional)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr_5" type="text" id="typeText" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>In Stock (Attr.5)</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input name="attr5_stock" type="number" id="typeNumber" class="form-control" value="0" step="1" min="0" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Image 1</td>
                                            <td>
                                                <input class="form-control" type="file" name="fileUpload1" id="fileUpload1" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Image 2</td>
                                            <td>
                                                <input class="form-control" type="file" name="fileUpload2" id="fileUpload2" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Image 3</td>
                                            <td>
                                                <input class="form-control" type="file" name="fileUpload3" id="fileUpload3" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Image 4</td>
                                            <td>
                                                <input class="form-control" type="file" name="fileUpload4" id="fileUpload4" />
                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                <button style="width:100%; margin-top:10px;" name="submit" type="submit" class="btn btn-primary">SUBMIT</button>
                                            </td>
                                        </tr>
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
            let name = document.forms["myForm"]["product_name"].value;
            let unitPrice = document.forms["myForm"]["unit_price"].value;
            let attr1 = document.forms["myForm"]["attr_1"].value;
            let img1 = document.forms["myForm"]["fileUpload1"].value;
            let img2 = document.forms["myForm"]["fileUpload2"].value;
            let img3 = document.forms["myForm"]["fileUpload3"].value;
            let img4 = document.forms["myForm"]["fileUpload4"].value;


            if (name == "") {
                alert("Name must be filled out");
                return false;
            } else if (unitPrice == "") {
                alert("Unit price must be filled out");
                return false;
            } else if (attr1 == "") {
                alert("Attribute1 must be filled out");
                return false;
            } else if (img1 == "") {
                alert("img1 must be filled out");
                return false;
            } else if (img2 == "") {
                alert("img2 must be filled out");
                return false;
            } else if (img3 == "") {
                alert("img3 must be filled out");
                return false;
            } else if (img4 == "") {
                alert("img4 must be filled out");
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