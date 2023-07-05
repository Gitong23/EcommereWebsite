    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">สิ้นค้าในตะกร้า</h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if ($_SESSION["cart"] == "") {
                        echo "<h5 style='text-align: center;'>ไม่มีสินค้า ในตะกร้า</h5>";
                    } else {
                    ?>
                        <div id="cart_container">
                            <table class="table table-striped text-center">
                                <thead>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Attr.</td>
                                    <td>Qty</td>
                                    <td>Price</td>
                                </thead>

                                <?php

                                $cart = $_SESSION["cart"];
                                $key = array_keys($cart);
                                $sum = 0;
                                for ($i = 0; $i < count($cart); $i++) {
                                    $s = $cart[$key[$i]];
                                    $ss = explode(",", $s);

                                    //Name/Attr/unit/qty
                                    echo "<tr>";
                                    echo "<td>" . ($i + 1) . "</td>";
                                    echo "<td>" . $ss[0] . "</td>";
                                    echo "<td>" . $ss[1] . "</td>";
                                    echo "<td>" . $ss[3] . "</td>";
                                    echo "<td>" . (floatval($ss[2]) * floatval($ss[3])) . "</td>";
                                    echo "</tr>";
                                    $sum += (floatval($ss[2]) * floatval($ss[3]));
                                }

                                ?>

                            </table>

                            <h5 style="text-align: center; color:red;">ราคาสินค้ารวม <?php echo $sum; ?> บาท</h5>
                            <h6 style="text-align: center; color:red;" id="ship_tag">ค่าส่ง 45 บาท</h6>

                            <div class="select_trans mt-4">

                                <span style="font-size: large;">เลือกการขนส่ง: </span>
                                <select class="form-select" style="width: 200px; display:inline-block;" aria-label="Default select example" onchange="shippingChange();" id="selectedShipper">
                                    <option selected value="1">Thai Pos</option>
                                    <option value="2">Flash Express</option>
                                    <option value="3">Kerry Express</option>
                                </select>


                            </div>
                        </div>
                    <?php } ?>

                </div>

                <?php
                if ($_SESSION["cart"] == "") {
                    echo "<div class='modal-footer'><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button></div>";
                } else {
                ?>
                    <div class="modal-footer" id="btn_cart">
                        <button type="button" class="btn btn-danger me-auto" onclick="deleteCart();" data-bs-dismiss="modal">Delete Cart</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <form action="http://localhost/shopa/controller/submitOreder.php" method="post" onsubmit="submitOrder();">
                            <input type="hidden" id="trans_price" name="trans_price" value="45">
                            <input type="hidden" id="trans_id" name="trans_id" value="1">
                            <button type="submit" class="btn btn-success">Confirm Order</button>
                        </form>

                    </div>

                    <script>
                        function deleteCart() {
                            $.get("http://localhost/shopa/controller/deleteCart.php", function(data, status) {
                                $("#cart_num").html(0);
                                $("#cart_container").html("ไม่มีสินค้า ในตะกร้า");
                                $("#btn_cart").html(" <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button> ");
                            });
                        }

                        function shippingChange() {
                            let selectShipper = $('#selectedShipper').val();
                            $.get("http://localhost/shopa/controller/getSelectShppingPrice.php?trans_id=" + selectShipper, function(data, status) {
                                $("#trans_price").val(data);
                                $("#trans_id").val(selectShipper);
                                let s = `ค่าส่ง ${data} บาท`;
                                $("#ship_tag").html(s);
                            });
                        }

                        function submitOrder() {
                            alert("Your order has been added!");
                            return true;
                        }
                    </script>

                <?php } ?>
            </div>
        </div>
    </div>