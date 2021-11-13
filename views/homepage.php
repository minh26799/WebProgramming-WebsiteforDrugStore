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
        body{
            display:flex;
            flex-direction: column;
        }
        header{
            position:fixed;
            width: 100%;
            left: 0;
            top: 0;
        }
        main{
            position: absolute;
            top: 150px;
            z-index: -1;
        }
        img.product-image{
            height: 120px;
            width: auto;
        }
        .col-xs-6.col-sm-4.col-md-3.col-lg-2{
            padding: 0px 10px;
        }
        .thumbnail{
            min-width: 208px;
        }
    </style>
</head>

<body>
    <header>
        <?php include "header.php";?>
    </header>
    <main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <div class="row">
            <?php
            while($row = $listProduct->fetch_assoc()){
                $imageURL = '../assets/images/' . $row['productname'] . '.jpeg';
            ?> 
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
    
                <div class="thumbnail">
                    <img class="product-image" src="<?php echo $imageURL;?>">
                    
                    
                    <div class="caption">
                        <a href="./product_detail?id=<?php echo $row['pid']?>">
                        <h4><?php echo $row['productname'];?></h4>
                        <p><?php echo number_format($row['price'],0) . "đ";?></p>
                        </a>
                        <p>
                            <button class="btn btn-default btn-rounded">Add to cart</button>
                            <button class="btn btn-primary btn-rounded">Buy Now</button>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            }   ?>
        </div>
    </div>
    <footer>
        <?php include "footer.php" ?>
    </footer>
    </main>
</html>