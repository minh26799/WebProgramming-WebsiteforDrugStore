<?php 

class Cart{

    private $connection;

    private function connect(){
        $this->$connection = new mysqli('localhost', 'root', '', 'webDB');
    }

    public function addToCart() {
        $this->connect();

        $uid = $session['username'];
        $pid = $post['productid'];
        $pname = $post['productname'];
        $quantity = $post['quantity'];
        $date = $post['date'];
        $phid = "";
        if (isset($_POST['pharmacyid'])){
            $phid = $post['pharmacyid'];
        }
        $pid = "SELECT DISTINCT * FROM `incart` WHERE `productid` = $pid AND `userid` = $uid";

        $uCresult = $this->$connection->query($userCart);

        if($uCresult->num_rows > 0){
            $row = $uCresult->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;
            $updateQ = "UPDATE `incart` SET `quantity` =  $newQuantity WHERE  `productid` = $pid AND `userid` = $uid";
            echo '<div> Updated successful </div>';
            $this->$connection->close();
        } else {
            $insertNew = "INSERT INTO `incart` (`userid`, `productid`,`pharmacyid`, `quantity`, `date`) VALUES ($uid, $pid, '', $quantity, $date) ";
            echo '<div> Successful add new product </div>';
            $this->$connection->close();
        }
    }
}

?>