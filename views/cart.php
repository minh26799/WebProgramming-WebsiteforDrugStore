<?php
session_start();
?>

<?php
include '../controllers/cart.controller.php';

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
		}

		img.product-image {
			height: 80px;
			width: auto;
		}

		.cart-table {
			overflow: scroll;
			overflow-x: hidden;
			height: 400px;
			width: 100%;
		}

		thead th {
			position: sticky;
			top: 0;
			background-color: white;
			z-index: 999;
		}
		
		tr {
			height: 50px;
		}
	</style>
</head>

<body>
	<header>
		<?php include "header.php" ?>
	</header>

	<main role="main">
		<div class="container-fluid" style="display: block;">


			<!-- Transactions in cart are fetched from user's session -->
			<?php
			if ($_GET) {
				$_SESSION['redirect_url'] = "../index.php/cart?userid=" . $_GET['userid'];

				$cart = new CartController();
				$cartItems = $cart->getCart($_GET['userid']);

				if ($cartItems && mysqli_num_rows($cartItems) > 0) { ?>

					<form action="../controllers/cart_processing.php" method="POST">
						<input type="submit" name="action" value="Empty Cart" class="btn btn-success" />
						<input type="hidden" name="userID" value="<?php echo $_GET['userid'] ?>" />
					</form>

					<div class="cart-table" style="width: 100%;">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Product</th>
									<th scope="col">Name</th>
									<th scope="col">Price</th>
									<th scope="col">Quantity</th>
									<th scope="col">Total</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>

								<?php while ($item = $cartItems->fetch_assoc()) {
									$imageURL = '../assets/images/' . $item['productname'] . '.jpeg';
								?>

									<tr>
										<td><img class="product-image" src="<?php echo $imageURL; ?>"></td>
										<td><?php echo $item['productname']; ?></td>
										<td>
											<?php echo $item['price'];
											$pro = $item['price'] * $item['quantity'];
											$total = $total + $pro;
											?>
										</td>
										<td>
											<form class="input-group" action="../controllers/cart_processing.php" method="POST" style="position: relative;">
												<span class="input-group-btn" style="margin-right: 30px;">
													<button name="action" value="Minus To Cart" class="btn btn-default"><span class="glyphicon glyphicon-minus"></span></button>
												</span>

												<input type="hidden" name="userID" value="<?php echo $_GET['userid'] ?>" />
												<input type="hidden" name="productID" value="<?php echo $item['pid'] ?>" />
												<input type="hidden" name="quantity" value="1">
												<input style="width: 75px; display: block;" type="text" class="text-center" value="<?php echo $item['quantity'] ?>">

												<span class="input-group-btn">
													<button name="action" value="Add To Cart" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
												</span>
											</form>
										</td>
										<td>
											<?php echo $pro; ?>
										</td>
										<td>
											<form action="../controllers/cart_processing.php" method="POST">
												<input type="hidden" name="userID" value="<?php echo $_GET['userid'] ?>" />
												<input type="hidden" name="productID" value="<?php echo $item['pid'] ?>" />
												<input type="submit" name="action" value="Remove" class="btn btn-danger" />
											</form>
										</td>
									</tr>

								<?php } ?>

							</tbody>
						</table>
					</div>

					<div class="total" style="text-align: center;">
						<h2>Total: <span><?php echo $total; ?></span></h2>
					</div>

					<?php
					$transaction = $cart->getCart($_GET['userid'])->fetch_all(MYSQLI_ASSOC);
					$transaction = base64_encode(serialize($transaction));
					?>

					<form style="text-align: center;" action="../controllers/cart_processing.php" method="POST">
						<input type="submit" name="action" value="Purchase" class="btn btn-success" />
						<input type="hidden" name="userID" value="<?php echo $_GET['userid'] ?>" />
						<input style="display: none;" type="hidden" name="transaction" value="<?php echo $transaction ?>" />
					</form>

				<?php } else { ?>
					<div style="text-align: center; padding: 50px;">
						<a class='btn btn-primary' style="font-size: 3rem;" href="./home">Your Cart is empty. Go buy some drugs!</a>
					</div>
			<?php }
			} ?>

		</div>
		<footer>
			<?php include "footer.php" ?>
		</footer>
	</main>

</html>