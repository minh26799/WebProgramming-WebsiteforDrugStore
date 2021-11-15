<?php

class Transaction
{

    private $connection;
    private function connect()
    {
        include('../views/config.php');
        $this->connection = new mysqli($servername, $username, $password, $dbname);
    }

    public function makeTransaction($userID, $productID, $quantity, $overall, $date)
    {
        $this->connect();

        $transactionID = uniqid("trans_");

        $query = "INSERT INTO transactions 
            (tid, userid, pid, quantity, overallprice, boughtdate) VALUES 
            ('$transactionID', '$userID','$productID', '$quantity', '$overall', '$date')";

        mysqli_query($this->connection, $query);
        $this->connection->close();
    }
}
