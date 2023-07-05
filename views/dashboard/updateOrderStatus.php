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
    <title>Shopa: Order Status</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            loadTable();
        });

        function loadTable() {
            let url = "http://localhost/shopa/controller/getWaitingOrder.php";
            let data;
            let template = "";

            $.getJSON(url, function(result) {

                $.each(result, function(i, field) {

                    let table = `
                        <tr>
                            <td>{no}</td>
                            <td>{order_id}</td>
                            <td>{user_id}</td>
                            <td>{last}</td>
                            <td>{shipper}</td>
                            <td>{total}</td>
                            <td><button type="button" class="btn btn-primary "  onclick="viewOrderDetail({order_id})">Veiw Detail</button></td>
                            <td><button type="button" class="btn btn-success "  onclick="confirmOrder({order_id});">CONFIRM</button></td>
                            <td><button type="button" class="btn btn-danger"    onclick="cancelOrder({order_id});">CANCEL</button></td>
                        </tr>
                    `;

                    table = table.replaceAll('{no}', i + 1);
                    table = table.replaceAll('{order_id}', field["order_id"]);
                    table = table.replaceAll('{user_id}', field["user_id"]);
                    table = table.replaceAll('{last}', field["last_update"]);
                    table = table.replaceAll('{shipper}', field["trans_name"]);
                    table = table.replaceAll('{total}', field["total"]);
                    template += table;
                });

                $("#table").html();
                $("#table").html(template);
                $("#waiting").html(`${result.length} Orders waiting confirmation`);

            });

        }

        async function viewOrderDetail(order_id) {

            $('#exampleModalLabel').html(`Product List in Order Id: ${order_id}`);
            let url = "http://localhost/shopa/controller/getOrderList.php?order_id=" + order_id;

            const response = await fetch(url);
            const data = await response.json();
            let table = "";

            for (let i = 0; i < data.length; i++) {
                let template = `
                            <tr>
                                <td>${i+1}</td>
                                <td>${data[i].product_name}</td>
                                <td>${data[i].qty}</td>
                                <td>${data[i].unit_price}</td>
                                <td>${data[i].price}</td>
                            </tr>
                 `;

                table += template;
            }

            $('#order_list').html(table);
            $('#exampleModal').modal('show');

        }

        function confirmOrder(order_id) {

            var confirm = {
                order_id: parseInt(order_id)
            };

            var options = {
                url: "http://localhost/shopa/controller/confirmOrderProcess.php",
                dataType: "text",
                type: "POST",
                data: {
                    dataJson: JSON.stringify(confirm)
                },
                success: function(result, status, xhr) {
                    if (result == "0") {
                        alert("Can't confirm order becuase not enough product in stock");
                    }

                    if (result == "1") {
                        alert("Order have confirm");
                        loadTable();
                    }
                },
            };

            $.ajax(options);
        }

        function cancelOrder(order_id) {
            var confirm = {
                order_id: parseInt(order_id)
            };

            var options = {
                url: "http://localhost/shopa/controller/cancelOrder.php",
                dataType: "text",
                type: "POST",
                data: {
                    dataJson: JSON.stringify(confirm)
                },
                success: function(result, status, xhr) {
                    alert("Order have been canceled");
                    // alert(result);
                    loadTable();
                },
            };

            $.ajax(options);
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
                    <h1 class="mt-4">Order Status</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Shopa</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Order waiting confirmation
                        </div>

                        <div class="card-body">
                            <h2 style="color: red;" id="waiting">100 Orders waiting confirmation</h2>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>No.</th>
                                        <th>Order ID</th>
                                        <th>User ID</th>
                                        <th>Last Update</th>
                                        <th>Shipper</th>
                                        <th>Total Price</th>
                                        <th>Veiw Detail</th>
                                        <th>Confirm</th>
                                        <th>Cancel</th>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product List in Order Id:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <table class="table table-striped text-center">

                        <thead>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Quantity</td>
                            <td>unit price</td>
                            <td>sum price</td>
                        </thead>
                        <tbody id="order_list">
                            <tr>
                                <td>sdsd</td>
                                <td>sdsd</td>
                                <td>sdsd</td>
                                <td>sdsd</td>
                                <td>sdsd</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>