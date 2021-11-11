<?php
session_start();
	require_once('router.php');
	include_once('controllers/login.controller.php');
	include_once('controllers/productDetail.controller.php');
	include_once('controllers/home.controller.php');

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
		echo "REGISTER";
	});

	$router->addRoute('/register', function($url){
		echo "REGISTER";
	});

	$router->addRoute('/product_detail', function($url){
		$productdetail = new ProductDetailController();
		print_r($productdetail->view($_GET['id']));
	});

	$router->run();
?>
