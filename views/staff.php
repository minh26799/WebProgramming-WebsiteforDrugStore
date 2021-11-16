<?php
include '../controllers/listProduct.controller.php';
?>
<!doctype html>
<html lang="en" class="h-100">

<head>

    <title>DrugStore</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
        }

        header {
            position: fixed;
            width: 100%;
            left: 0;
            top: 0;
        }

        main {
            position: absolute;
            top: 150px;
            z-index: -1;
        }

    </style>
</head>

<body>
    <header>
        <?php include "header.php"; ?>
    </header>
    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <body>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                        Select Image File to Upload:
                    <input type="file" name="file">
                    <input type="submit" name="submit" value="Upload">
                </form>
                <hr>
                <?php
                // Include the database configuration file
                include 'config.php';
                // Get images from the database
                $query = $db->query("SELECT file_name FROM images ORDER BY uploaded_on DESC");
                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        $imageURL = 'uploads/'.$row["file_name"];
                ?>
                    <img src="<?= $imageURL; ?>" />
                <?php }} ?>
            </body>
        </div>
        <footer>
            <?php include "footer.php" ?>
        </footer>
    </main>

</html>