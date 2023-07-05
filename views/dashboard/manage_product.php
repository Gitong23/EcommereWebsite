<?php

error_reporting(E_ERROR | E_PARSE);
$return = $_GET["return"];

session_start();

if ($_SESSION['user_status'] != "admin") {
    header("Location: http://localhost/shopa");
    exit();
}

if ($return == "") {
    $return = 1;
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
    <title>Manage Product : Shopa Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            startSelect();

            $('#list').change(function() {
                if ($(this).val() === '1') {
                    // console.log("food");
                    getDataByCatId(1);
                }

                if ($(this).val() === '2') {
                    // console.log("electronic");
                    getDataByCatId(2);
                    console.log("2");
                }

                if ($(this).val() === '3') {
                    // console.log("fashion");
                    getDataByCatId(3);
                    console.log("3");
                }

                if ($(this).val() === '4') {
                    // console.log("entertainment");
                    getDataByCatId(4);
                    console.log("4");
                }

                if ($(this).val() === '5') {
                    // console.log("pet");
                    getDataByCatId(5);
                    console.log("5");
                }

                if ($(this).val() === '6') {
                    // console.log("automotive");
                    getDataByCatId(6);
                    console.log("6");
                }

                if ($(this).val() === '7') {
                    // console.log("commodity");
                    getDataByCatId(7);
                    console.log("7");
                }

                if ($(this).val() === '8') {
                    // console.log("etc");
                    getDataByCatId(8);
                    console.log("8");
                }

            });

        });

        function editProductAttr(product_attr, cat_id) {
            // console.log(x);
            let url = "http://localhost/shopa/views/dashboard/editProductAttr.php?product_attr=" + product_attr + "&cat_id=" + cat_id;
            window.location.replace(url);
        }

        function deleteProductAttr(product_attr, cat_id) {
            let url = "http://localhost/shopa/controller/deleteDataTable.php?product_attr=" + product_attr + "&cat_id=" + cat_id;
            window.location.replace(url);
        }

        function startSelect() {
            let x = $("#starter").val();
            $("#list").val(x);
            getDataByCatId(x);
        }

        function getDataByCatId(cat_id) {
            let url = "http://localhost/shopa/controller/manageTable.php?cat_id=" + cat_id;
            let data;
            let template = "";

            $.getJSON(url, function(result) {
                // console.log(result);

                $.each(result, function(i, field) {

                    let table = `
                        <tr>
                            <td>{no}</td>
                            <td>{product_name}</td>
                            <td>{product_attr}</td>
                            <td>{unit}</td>
                            <td>{sale}</td>
                            <td>{product_stock}</td>
                            <td><button type="button" class="btn btn-warning edit" pro_attr={product_attr_id} onclick="editProductAttr({product_attr_id},${cat_id})">EDIT</button></td>
                            <td><button type="button" class="btn btn-danger" onclick="deleteProductAttr({product_attr_id},${cat_id})">DELETE</button></td>
                        </tr>
                    `;

                    table = table.replaceAll('{no}', i + 1);
                    table = table.replaceAll('{product_name}', field["product_name"]);
                    table = table.replaceAll('{product_attr}', field["attr_name"]);
                    table = table.replaceAll('{unit}', field["unit_price"]);
                    table = table.replaceAll('{sale}', field["sale"]);
                    table = table.replaceAll('{product_stock}', field["product_stock"]);
                    table = table.replaceAll('{product_attr_id}', field["product_attr_id"]);
                    template += table;
                });

                $("#table").html();
                $("#table").html(template);

            });

        }
    </script>

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
                    <h1 class="mt-4">Product Management</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Shopa</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Manage Form
                            <input type="hidden" id="starter" value="<?php echo $return ?>">
                        </div>
                        <div class="card-body">
                            <select id="list" style="width:300px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected>Please Select Category</option>
                                <option value="1">Food</option>
                                <option value="2">Electornic</option>
                                <option value="3">Fashion</option>
                                <option value="4">Entertainment</option>
                                <option value="5">Pet</option>
                                <option value="6">Automotive</option>
                                <option value="7">Commodity</option>
                                <option value="8">Etc</option>
                            </select>

                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>No.</th>
                                        <th>Product Name</th>
                                        <th>Product Attr.</th>
                                        <th>Unit Price</th>
                                        <th>Sale</th>
                                        <th>Remain in Stock</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="table" style="text-align:center;">


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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>