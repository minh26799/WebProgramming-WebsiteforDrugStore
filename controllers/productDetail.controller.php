<?php 

class ProductDetailController {
    
    public function view($id){
        // $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
        
            // $context = stream_context_create($opts);
            // session_write_close(); // unlock the file
            $data = http_build_query(array('id' => $id));
            // $options = array( 
            //     'http' => array(
            //         'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
            //         "Content-Length: ".strlen($data)."\r\n".
            //         "User-Agent: MyAgent/1.0\r\n" . 
            //         "Cookie: " . $_SERVER['HTTP_COOKIE']."\r\n", 
            //     'method' => 'GET', 
            //     'content' => $data) 
            // ); 
            // $stream = stream_context_create($options);
            echo $data;
            $result = file_get_contents('http://' . $_SERVER['SERVER_NAME'] . '/WebProgramming-WebsiteforDrugStore/views/product_detail.php?'.$data, false);
            session_start();
            return $result;
    }

    public function getDetail($id) {
        include_once('../models/product.php');

        $product = new Products();
        $productDetail = $product->getDetail($id);
        return $productDetail;
    }

}
?>