<?php
include "function.php";

$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "webDB";

$connection = mysqli_connect($sname, $unmae, $password, $db_name);
if (!$connection) {
    echo "Connection failed!";
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {

    $uuid = uniqid();
    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $rpass = validate($_POST['password2']);
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $phone = validate($_POST['phone']);
    
    if (empty($uname)) {
        header("Location: registerBox.php?error=User name is require");
        exit();
    } else if (empty($pass)) {
        header("Location: registerBox.php?error=Password is require");
        exit();
    } else if (empty($rpass)) {
        header("Location: registerBox.php?error=Repeat password is require");
        exit();
    } else if (empty($uname)) {
        header("Location: registerBox.php?error=Name is required");
        exit();
    } else if ($pass != $rpass) {
        header("Location: registerBox.php?error=The confirmation password does not match");
        exit();
    } else {
        $pass = md5($pass);
        $sql = "SELECT * FROM users WHERE username = '$uname'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            header("Location: registerBox.php?error=Username is taken");
            exit();
        } else {
            // $sql2 = "INSERT INTO users (username, password, firstname, lastname, phone) VALUES('$uname', '$pass', '$fname' ,'$lname', '$phone')";
            $sql2 = "INSERT INTO users VALUES ('$uuid','$uname', '$pass', '$fname' ,'$lname', '$phone')";
            $result2 = mysqli_query($connection, $sql2);
            if ($result2) {
                header("Location: registerBox.php?success=Successfully registered");
                exit();
            } else {
                header("Location: registerBox.php?error=unknown error occurred");
                exit();
            }
        }
    }
} else {
    header("Location: registerBox.php");
    exit();
}
$connection->close();
