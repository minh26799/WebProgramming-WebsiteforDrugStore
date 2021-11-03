<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	if(isset($_REQUEST['page'])){
		if ($_REQUEST['page'] == 'home' || $_REQUEST['page']==''){
			require 'F:\xampp_\htdocs\drug-store\home.php';
		}
		if ($_REQUEST['page'] == 'product'){
			require 'F:\xampp_\htdocs\drug-store\product.php';
		}
		if ($_REQUEST['page'] == 'register'){
			require 'F:\xampp_\htdocs\drug-store\register.php';
		}
		if ($_REQUEST['page'] == 'login'){
			require 'F:\xampp_\htdocs\drug-store\login.php';
		}
	}
?>
