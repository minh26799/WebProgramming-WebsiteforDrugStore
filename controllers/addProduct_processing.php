<?php 

include_once('../models/product.php');

$product = new Products();
echo "RUN PLEASE1";
$product->AddProduct($_POST['productname'],$_POST['price'], $_POST['treatment'], $_POST['description'], $_POST['pharmacyname'],$_POST['quantity'], $_FILES["file"]["name"], $_FILES["file"]["tmp_name"]);
echo "RUN PLEASE";
?>