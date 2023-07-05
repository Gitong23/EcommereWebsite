<?php

require_once('../model/product/output/product_function.php');
require_once('../model/score/output/score_function.php');
session_start();

$json = ($_POST['dataJson']);
$data = json_decode($json);

$user_id = intval($data->user_id);
$product = intval($data->product);
if (checkUserScore($user_id, $product)) {
    echo "You already add score!!";
    exit();
}

$score = intval($data->score);
insertNewscore(0, $user_id, $product, $score);

$total = intval($data->total) + $score;
$review = intval($data->review) + 1;
updateScoreProduct($product, $total, $review);

echo "Score have been added";
