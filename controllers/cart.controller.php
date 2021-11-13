<?php

class CartController {
        
        public function view($userID) {
            
            $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
            $context = stream_context_create($opts);
            session_write_close(); // unlock the file

            $data = http_build_query(array('userid' => $userID));

            $result = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/WebProgramming-WebsiteforDrugStore/views/cart.php?'.$data, false, $context);
            session_start();
            return $result;
        }

        public function getCart($userID) {
            include_once('../models/cart.php');
    
            $cart = new Cart();
            $cartItems = $cart->listCart($userID);
            return $cartItems;
        }

}
?>