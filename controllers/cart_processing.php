<?php
include_once('../views/config.php');
include_once('../models/cart.php');



if ($_POST['action'] == "Buy Now") {
    $currentDate = new DateTime();
    $date = $currentDate->format('Y-m-d H:i:s');
    $cart = new Cart();
    $cart->addToCart($_POST['userID'], $_POST['productID'], $_POST['quantity'], $date);

    $user = $_POST['userID'];
    $url = "../index.php/cart?userid=$user";

    header("Location:" . $url);
    exit();
} elseif ($_POST['action'] == "Add To Cart") {
    $currentDate = new DateTime();
    $date = $currentDate->format('Y-m-d H:i:s');
    $cart = new Cart();
    $cart->addToCart($_POST['userID'], $_POST['productID'], $_POST['quantity'], $date);

    session_start();
    $redirect_url = (isset($_SESSION['redirect_url'])) ? $_SESSION['redirect_url'] : '/';
    unset($_SESSION['redirect_url']);

    header("Location:" . $redirect_url);
}
