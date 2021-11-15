<?php
session_start();
?>

<?php
include '../controllers/profile.controller.php';

// Total amount of money
$total = 0;
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
            width: 100%;
        }

        .input-group {
            display: flex;
            flex-direction: row;
        }

        img.product-image {
            height: 80px;
            width: auto;
        }
    </style>
</head>

<body>
    <header>
        <?php include "header.php" ?>
    </header>

    <main role="main">
        <div class="container-fluid">

            <div class="user-profile">
                <!-- CODE HERE, Đăng -->
            </div>

            <div class="cart-table" style="width: 100%;">

                <table class="table" style="border-bottom: 1px #e3e3e3 solid; margin-bottom:20px;">


                    <!-- Transactions in cart are fetched from user's session -->
                    <?php
                    if ($_GET) {

                        $profile = new ProfileController();
                        $transaction = $profile->getTransaction($_GET['userid']);
                        $total = 0;

                        if ($transaction && mysqli_num_rows($transaction) > 0) { ?>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($item = $transaction->fetch_assoc()) {
                                        $imageURL = '../assets/images/' . $item['productname'] . '.jpeg';
                                        $total = $total + $item['overallprice'];
                                    ?>

                                        <tr>
                                            <td><img class="product-image" src="<?php echo $imageURL; ?>"></td>
                                            <td><?php echo $item['productname']; ?></td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td><?php echo $item['overallprice']; ?></td>
                                            <td><?php echo $item['boughtdate']; ?></td>
                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                            <div class="total" style="text-align: center;">
                                <h2>Total Money Spent: <span><?php echo $total; ?></span></h2>
                            </div>

                        <?php } else { ?>
                            <div style="text-align: center; padding: 50px;">
                                <a class='btn btn-primary' style="font-size: 3rem;" href="./home">No transaction yet. Go buy some drugs!</a>
                            </div>
                    <?php }
                    } ?>
            </div>

        </div>
        <footer>
            <?php include "footer.php" ?>
        </footer>
    </main>

</html>