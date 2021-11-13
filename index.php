<?php
session_start();
	require_once('router.php');
	include_once('controllers/login.controller.php');
	include_once('controllers/register.controller.php');
	include_once('controllers/productDetail.controller.php');
	include_once('controllers/home.controller.php');
	include_once('controllers/cart.controller.php');

	$router = new Router();
	$router->addRoute('/home', function($url){
		$home = new HomeController();
		print_r($home->view());
	});

	$router->addRoute('/login', function($url){
		$login = new LoginController();
		print_r($login->view());
	});

	$router->addRoute('/register', function($url){
		$register = new RegisterController();
		print_r($register->view());
	});

	$router->addRoute('/product_detail', function($url){
		$productdetail = new ProductDetailController();
		print_r($productdetail->view($_GET['id']));
	});

	$router->addRoute('/cart', function($url){
		$cart = new CartController();
		print_r($cart->view($_GET['userid']));
	});

	$router->run();
?>
