<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webDB";


$conn = new mysqli($servername, $username, $password);

$db = "CREATE DATABASE IF NOT EXISTS webDB";
if($conn->query($db) === TRUE){
    echo "db created!";
} else{ 
    echo "ERROR: ". $conn->error;
}

$connection = new mysqli($servername, $username, $password, $dbname);


if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}
$connection->query($db);

$usertable = "CREATE TABLE IF NOT EXISTS `users` (
    `uid` VARCHAR(40) NOT NULL,
    `username` VARCHAR(256) NOT NULL ,
    `password` VARCHAR(256) NOT NULL,
    `firstname` VARCHAR(50),
    `lastname` VARCHAR(50),
    `phone` VARCHAR(15),
    PRIMARY KEY (`uid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$transactiontable = "CREATE TABLE IF NOT EXISTS `transactions`(
    `tid` VARCHAR(40) NOT NULL,
    `userid` VARCHAR(40) NOT NULL,
    `pid` VARCHAR(40) NOT NULL,
    `quantity` INT UNSIGNED NOT NULL,
    `overallprice` FLOAT NOT NULL,
    `boughtdate` datetime NOT NULL,
    PRIMARY KEY (`tid`, `userid`),
    FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
    CONSTRAINT `FK_UserTransactions` FOREIGN KEY (`userid`) REFERENCES `users`(`uid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$producttable = "CREATE TABLE IF NOT EXISTS `products`(
    `pid` VARCHAR(40) NOT NULL,
    `productname` VARCHAR(100) NOT NULL,
    `condition` VARCHAR(256) NOT NULL, 
    `price` FLOAT NOT NULL,
    `pharmacyid` VARCHAR(40) NOT NULL,
    CONSTRAINT `belongto` FOREIGN KEY (`pharmacyid`) REFERENCES `pharmacy`(`phid`),
    PRIMARY KEY (`pid`, `pharmacyid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$pharmacytable = "CREATE TABLE IF NOT EXISTS `pharmacy`(
    `phid` VARCHAR(40) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `latitude` FLOAT NOT NULL,
    `longitude` FLOAT NOT NULL,
    PRIMARY KEY (`phid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;";


$uchecker = $connection->query($usertable);
$phchecker = $connection-> query($pharmacytable);
$pchecker = $connection->query($producttable);
$tchecker = $connection->query($transactiontable);


if($uchecker != TRUE) {
    echo "ERROR: ". $connection->error;
} else if($tchecker !== TRUE) {
    echo "ERROR: ". $connection->error;
} else if ($pchecker !== TRUE) {
    echo "ERROR: ". $connection->error;
} else if ($phchecker !== TRUE){
    echo "ERROR: ". $connection->error;
} else {
    echo "tables created!";
}
$connection->close();
?>
