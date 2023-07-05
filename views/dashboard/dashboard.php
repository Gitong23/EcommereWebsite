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

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            loadTable("getBestSeller");
        });

        function loadTable(status) {

            let s = "<i class='fas fa-table me-1'></i>";

            if (status == "getAll") {
                s += "แสดงสินค้าทั้งหมด";
            } else if (status == "getBestSeller") {
                s += "10 อันดับสินค้าขายดี";
            } else if (status == "getCloseStock") {
                s += "สินค้าที่ใกล้หมดสต็อก";
            } else if (status == "getOutStock") {
                s += "สิ้นค้าที่หมดสต็อกแล้ว";
            }

            $("#cardHeader").html(s);

            let url = "http://localhost/shopa/controller/getDashBoardData.php?status=" + status;
            let template = "";

            $.getJSON(url, function(result) {

                $.each(result, function(i, field) {

                    let table = `
                        <tr>
                            <td>{no}</td>
                            <td>{product_name}</td>
                            <td>{product_attr}</td>
                            <td>{unit}</td>
                            <td>{sale}</td>
                            <td>{product_stock}</td>
                            <td><button type="button" class="btn btn-warning edit" onclick="editProductAttr({product_attr_id});">EDIT</button></td>
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

        function editProductAttr(product_attr) {
            let url = "http://localhost/shopa/views/dashboard/editProductAttr.php?product_attr=" + product_attr;
            window.location.replace(url);
        }
    </script>

</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../../index.php">Shopa</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>

    <!-- Side Menu -->
    <div id="layoutSidenav">

        <?php include('sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5>แสดงสินค้าทั้งหมด</h5>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" onclick="loadTable('getAll');">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5>10 อันดับสินค้าขายดี</h5>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" onclick="loadTable('getBestSeller');">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5>สินค้าที่ใกล้หมดคลัง</h5>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" onclick="loadTable('getCloseStock');">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h5>สินค้าที่หมดคลังแล้ว</h5>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" onclick="loadTable('getOutStock');">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Show all product -->
                    <div class="card mb-4">
                        <div class="card-header" id="cardHeader">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
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