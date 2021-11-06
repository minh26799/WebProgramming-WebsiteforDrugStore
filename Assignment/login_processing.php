<?php
    include_once ('config.php');
    include_once('Users.php');
    session_start();
    $newUser = new Users();
    $newUser->createConnection($ServerName, $Username, $Password, $dbname);
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $newUser->login($_POST);
    } else {
        header("Location: ./index.php");
        exit();
    }
    $newUser->connection->close();
?>