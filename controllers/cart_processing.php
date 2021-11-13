<?php
    include_once ('../views/config.php');
    include_once('../models/cart.php');

    $currentDate = new DateTime();
    $date = $currentDate->format('Y-m-d H:i:s');

    $cart = new Cart();
    $cart->addToCart($_POST['userID'], $_POST['productID'], $_POST['quantity'], $date);

    if($_POST['action'] == "BuyNow"){

        $user = $_POST['userID'];
        $url = "../index.php/cart?userid=$user";

        header("Location:".$url);
        exit();
    }
