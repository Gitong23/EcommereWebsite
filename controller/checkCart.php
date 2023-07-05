<?php

session_start();

print_r($_SESSION);

if (($_SESSION["cart"] == "") || ($_SESSION["cart"] == "empty")) {
    echo "nothing";
} else {
    echo count($_SESSION["cart"]) . "<br>";
    // for($i = 0; $i < count($_SESSION["cart"]))
    $cart = $_SESSION["cart"];
    $key = array_keys($cart);
    for ($i = 0; $i < count($cart); $i++) {
        echo $key[$i] . " : " . $cart[$key[$i]] . "<br>";
    }
}
