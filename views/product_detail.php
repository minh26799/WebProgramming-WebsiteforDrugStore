<?php
    include '../controllers/productDetail.controller.php';
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
        .input-group{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>

<body>
    <header>
        <?php include "header.php" ?>
    </header>

    <main role="main" class="flex-shrink-0">
    <div class="container-fluid">
    <div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="https://via.placeholder.com/430x600/00CED1/000000" class="img-responsive"></div>
                </div>
                <?php 
                
                $productdetail = new ProductDetailController();
                $detail = $productdetail->getDetail($_GET['id'])->fetch_assoc();
                echo $detail['price'];
                ?> 
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h1>Than Long An</h1>
                    <h2 class="mt-5">
                        $0
                    </h2>
                    <h4 class="box-title mt-5">Product description</h4>
                    <p>Lorem Ipsum available,but the majority have suffered alteration in some form,by injected humour,or randomised words which don't look even slightly believable.but the majority have suffered alteration in some form,by injected humour</p>
                    
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">+</button>
                        </span>
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">+</button>
                        </span>
                    </div>
                    <button class="btn btn-primary btn-rounded">Buy Now</button>
                    <button class="btn btn-primary btn-rounded">Buy Now</button>
                    <h3 class="box-title mt-5">Key Highlights</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check text-success"></i>Than trong mọi hoàn cảnh</li>
                        <li><i class="fa fa-check text-success"></i>Than bất kể thời tiết</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>
    </div>
    <footer>
        <?php include "footer.php" ?>
    </footer>
    </main>
</html>