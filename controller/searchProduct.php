<?php
require_once('../model/product/output/product_function.php');

if (isset($_GET['search'])) {
    $keyWord = $_GET['search'];
    $data = getSearchProduct($keyWord);
    $json = json_encode($data);

    echo $json;
}
