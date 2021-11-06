<?php
    include_once ('config.php');
    include_once('Users.php');
    $newUser = new Users();
    $newUser->createConnection($ServerName, $Username, $Password, $dbname);
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname'])&& isset($_POST['lastname'])) {
        $newUser->register($_POST);
    } else {
        header("Location: ./index.php");
        exit();
    }
    $newUser->connection->close();
?>
