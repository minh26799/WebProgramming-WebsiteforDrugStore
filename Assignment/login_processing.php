<?php
include "./function.php";
session_start();

$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "webDB";

$connection = mysqli_connect($sname, $unmae, $password, $db_name);
if (!$connection) {
    echo "Connection failed!";
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $Username = validate($_POST['username']);
    $Password = validate($_POST['password']);
    $Password = md5($Password);
    // Check the Username
    if (empty($Username)) {
        header("Location: ./index.php?error=Username must be filled");
        exit();
    }
    if (empty($Password) || !empty($Username) && empty($Password)) {
        header("Location: ./index.php?error=Password is required");
        exit();
    } else if ($Password === "Passoword" || $Password === "password") {
        header("Location: ./index.php?error=Password must not be \'Password\' or \'password\'");
        exit();
    } else if (preg_match('/[A-Z]/', $Password)) {
        header("Location: ./index.php?error=Must be at least an uppercase letter");
        exit();        
    } else {
        $sql = "SELECT * FROM users WHERE username = '$Username' AND password = '$Password'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                echo $row;
            if ($row['username'] === $Username && $row['password'] === $Password) {
                //store value of account to display when succesfully login
                $_SESSION['username']=$row['username'];
                $_SESSION['firstname']=$row['firstname'];
                $_SESSION['lastname']=$row['lastname'];
                $_SESSION['id']=$row['uid'];
                header("Location: ./home.php");
                exit();
        } else {
            header("Location: ./index.php?error=Incorect Username or Password");
            exit();
        }
        } else {
            header("Location: ./index.php?error=Incorect User name or password");
            exit();
        }
    }
} else {
    header("Location: ./index.php");
    exit();
}
?>