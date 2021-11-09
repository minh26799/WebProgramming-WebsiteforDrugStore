<?php
	// if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// } 
	// $uri .= $_SERVER['HTTP_HOST'];
	// if(isset($_REQUEST['page'])){
	// 	if ($_REQUEST['page'] == 'home' || $_REQUEST['page']==''){
	// 		require 'F:\xampp_\htdocs\drug-store\home.php';
	// 	}
	// 	if ($_REQUEST['page'] == 'product'){
	// 		require 'F:\xampp_\htdocs\drug-store\product.php';
	// 	}
	// 	if ($_REQUEST['page'] == 'register'){
	// 		require 'F:\xampp_\htdocs\drug-store\register.php';
	// 	}
	// 	if ($_REQUEST['page'] == 'login'){
	// 		require 'F:\xampp_\htdocs\drug-store\login.php';
	// 	}
	// }
	require_once('router.php');
	include_once('controllers/login.controller.php');


	$router = new Router();
	
	$router->addRoute('/$', function($url){
		$login = new LoginController();
		print_r($login->view());
	});

	$router->addRoute('/login', function($url){
		echo "LOGIN";
	});

	$router->addRoute('/register', function($url){
		echo "REGISTER";
	});

	$router->addRoute('/register', function($url){
		echo "REGISTER";
	});

	$router->addRoute('/product_detail', function($url){
		$question = new QuestionController();
		print_r($question->view('edit', $_GET['id']));
	});

	$router->run();
?>
