<?php

class Products
{
    private $connection;
    private function connect()
    {
        $this->connection = new mysqli('localhost', 'root', '', 'webdb');
    }

    public function getProductList() {
        $this->connect();
        $sql_cmd = "SELECT * FROM products;";
        $result = $this->connection->query($sql_cmd);

        if ($result->num_rows == 0) {
            echo '<script type="text/javascript">
                alert("Can\'t get list of product!");
            </script>';
            return;
        } else {
            $this->connection->close();
            return $result;
        }
    }
}
?>