<?php 

class Cart{

    private $connection;
    private function connect()
    {
        $this->connection = new mysqli('localhost', 'root', '', 'webDB');
    }

    public function listCart($userID){
        $this->connect();

        $sql_cmd = "SELECT p.productname, p.price, quantity FROM `incart` 
        JOIN products p ON incart.productid = p.pid
        WHERE `userid` = '$userID'";

        $result = mysqli_query($this->connection, $sql_cmd);
        
        if (mysqli_num_rows($result) == 0) {
            echo '<script type="text/javascript">
                alert("Can\'t get list!");
            </script>';
            return;
        } else {
            $this->connection->close();
            return $result;
        }
    }

    public function addToCart($userID, $pID, $quantity, $date) {
        $this->connect();
        

        $phid = 'NULL';
        // if (isset($_POST['pharmacyid'])){
        //     $phid = $_POST['pharmacyid'];
        // }

        $product = "SELECT * FROM `incart` WHERE `productid` = '$pID' AND `userid` = '$userID'";

        $uCresult = mysqli_query($this->connection, $product);

        

        if(mysqli_num_rows($uCresult) > 0){
        
            $row = $uCresult->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;
            $updateQ = "UPDATE `incart` SET `quantity` =  '$newQuantity' WHERE  `productid` = '$pID' AND `userid` = '$userID'";
            mysqli_query($this->connection, $updateQ);

            echo '<div> Updated successful </div>';
            $this->connection->close();

            return true;
        } else {            
            $query = "INSERT INTO incart 
            (userid, productid, quantity, date, pharmacyid) VALUES 
            ('$userID','$pID', '$quantity', '$date', $phid)";
            
            mysqli_query($this->connection, $query);

            echo '<div> Successful add new product </div>';
            $this->connection->close();

            return true;
        }
    }
}
