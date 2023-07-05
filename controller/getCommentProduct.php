<?php
require_once('../model/comment/output/comment_function.php');
$product_id = intval(trim($_GET['product_id']));
$data = getCommentByProdId($product_id);
// if (count($data) == 0) {

//     $json = json_encode(array(array(0)));
//     echo $json;
//     exit();
// }
// print_r($data);
$json = json_encode($data);
echo $json;
