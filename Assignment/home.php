<?php
session_start();
//check if session is valid
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>HOME</title>
        <link rel="stylesheet" href="./assets/Icon/themify-icons.css">
        
        <style>
            .background {
                font-family: Arial, Helvetica, sans-serif;
                height: 200px;
                margin-top: 200px;
                text-align: center;
                position: relative;
                bottom: 20%;
                right: 0;
                left: 0;
            }
        </style>
        <link rel="stylesheet" href="./assets/css/style.css">
    </head>

    <body>
        <div class="background">
            <h1>Hello, <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h1>
            <a href="logout.php">Logout</a>
        </div>
    </body>
    </html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>