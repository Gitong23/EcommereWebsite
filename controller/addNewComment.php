<?php

require_once('../model/comment/output/comment_function.php');
$json = ($_POST['dataJson']);
$data = json_decode($json);

$user_id = intval($data->user_id);
$product_id = intval($data->product_id);
$content = $data->content;

if (insertNewcomment(0, $user_id, $product_id, $content)) {
    echo "Comment has been added!";
} else {
    echo "Adding comment fail !!";
}
