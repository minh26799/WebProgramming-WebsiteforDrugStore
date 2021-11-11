<?php
    include_once ('../views/config.php');
    include_once('../models/Users.php');
    session_start();
    $newUser = new Users();
    $newUser->createConnection($ServerName, $Username, $Password, $dbname);
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $checker = $newUser->login($_POST);
        if ($checker){
            header("Location: ../index.php/home");
        }
    } else {
        header("Location: ../index.php/login");
        exit();
    }
    $newUser->connection->close();
?>