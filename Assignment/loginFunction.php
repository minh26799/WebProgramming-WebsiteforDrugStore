<?php
// session_start();
// include "database.php";
include "function.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $Username = validate($_POST['username']);
    $Password = validate($_POST['password']);
    // Check the Username
    if (empty($Username)) {
        header("Location: index.php?error=Username must be filled");
        exit();
    }
    if (empty($Password) || !empty($Username) && empty($Password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else if ($Password === "Passoword" || $Password === "password") {
        header("Location: index.php?error=Password must not be \'Password\' or \'password\'");
        exit();
    } else if (preg_match('/[A-Z]/', $Password)) {
        header("Location: index.php?error=Must be at least an uppercase letter");
        exit();        
    } else {
        $sql = "SELECT * FROM users WHERE user_name='$Username' AND password='$Password'";

        // $result=mysqli_query($conn, $sql); mysqli_num_rows($result) === 1

        if ($Username === "minhdang2803" && $Password === "28032001") {
            // $row=mysqli_fetch_assoc($result);
            // if ($row['user_name'] === $Username && $row['password'] === $Password) {
            //     $_SESSION['user_name']=$row['user_name'];
            //     $_SESSION['name']=$row['name'];
            //     $_SESSION['id']=$row['id'];
            //     header("Location: home.php");
            echo "Sucessfully";
            exit();
        } else {
            header("Location: index.php?error=Incorect Username or Password");
            exit();
        }
        // } else {
        //     header("Location: index.php?error=Incorect User name or password");
        //     exit();
        // }
    }
} else {
    header("Location: index.php");
    exit();
}
