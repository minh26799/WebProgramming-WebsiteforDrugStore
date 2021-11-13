<?php
session_start();
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

        .input-group.number-spinner {
            width: 20%;
        }

        .col-lg-7.col-md-7.col-sm-6 {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #submit-button{
            position: absolute;
            top: 50px;
            left: -50px;
            display: flex;
        }
    </style>
</head>

<body>
    <header>
        <?php include "header.php"; ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $productdetail = new ProductDetailController();
                            $detail = $productdetail->getDetail($_GET['id'])->fetch_assoc();
                            $imageURL = '../assets/images/' . $detail['productname'] . '.jpeg';
                            ?>
                            <div class="col-lg-5 col-md-5 col-sm-6">
                                <div class="white-box text-center"><img src="<?php echo $imageURL; ?>" class="img-responsive"></div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6">
                                <h1><?php echo $detail['productname'] ?></h1>
                                <h2 class="mt-5">
                                    <?php echo number_format($detail['price'], 0) . "đ"; ?>
                                </h2>
                                <h4 class="box-title mt-5">Product description</h4>
                                <p><?php echo $detail['description'] ?></p>

                                <div class="input-group number-spinner">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                                    </span>

                                    <?php $_SESSION['redirect_url'] = "../index.php/product_detail?id=" . $_GET['id']; ?>

                                    <form action="../controllers/cart_processing.php" method="POST" style="position: relative;">
                                        <input type="hidden" name="userID" value="<?php echo $_SESSION['id'] ?>" />
                                        <input type="hidden" name="productID" value="<?php echo $_GET['id'] ?>" />
                                        <input type="text" name="quantity" class="form-control text-center" value="1">
                                        <div id="submit-button">
                                            <input type="submit" name="action" value="Add To Cart" class="btn btn-default" style="margin-right: 10px;"/>
                                            <input type="submit" name="action" value="Buy Now" class="btn btn-primary" />
                                        </div>
                                    </form>

                                    <span class="input-group-btn">
                                        <button class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                                    </span>
                                </div>



                                <div>
                                </div>

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
</body>
<script>
    $(document).on('click', '.number-spinner button', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find("input[name='quantity']").val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find("input[name='quantity']").val(newVal);
    });
</script>

</html>