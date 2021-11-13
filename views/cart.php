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

			<div class="cart-table" style="width: 100%;">

				<table class="table" style="border-bottom: 1px #e3e3e3 solid; margin-bottom:20px;">


					<!-- Transactions in cart are fetched from user's session -->
					<?php
					if ($_GET) {

						$cart = new CartController();
						$cartItems = $cart->getCart($_GET['userid']);

						if ($cartItems && mysqli_num_rows($cartItems) > 0) { ?>

							<form action="../controllers/cart_processing.php" method="POST">
								<input type="hidden" name="userID" value="<?php echo $_GET['userid'] ?>" />
								<input type="submit" name="action" value="Empty Cart" class="btn btn-success" />
							</form>

							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">Product</th>
										<th scope="col">Name</th>
										<th scope="col">Quantity</th>
										<th scope="col">Price</th>
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
											<td><?php echo $item['quantity']; ?></td>
											<td>
												<?php echo $item['price'];
												$pro = $item['price'] * $item['quantity'];
												$total = $total + $pro;
												?>
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

							<?php } else { ?>
								<div style="text-align: center; padding: 50px;">
									<a class='btn btn-primary' style="font-size: 3rem;" href="./home">Your Cart is empty. Go buy some drugs!</a>
								</div>
						<?php }
					} ?>

							</table>

							<div class="total" style="text-align: center;">
								<h2>Total: <span><?php echo $total; ?></span></h2>
							</div>
			</div>

			<!-- <form action="cart.php" method="POST">
				<?php if (isset($success)) {
					echo $success;
				} ?>
				<input type="text" name="name" placeholder="Enter Name" autocomplete="off" required>
				<input type="text" name="address" placeholder="Enter Address" autocomplete="off" required>
				<input type="text" name="phone" placeholder="Enter Phone Number" autocomplete="off" required>
				<input type="text" name="email" placeholder="Enter Email Address (Optional)" autocomplete="off">
				<div class="radio">
					<label>Cash On Delivery:</label>
					<input type="radio" name="method" value="Cash On Delivery" checked>
					<label>Bank Transfer:</label>
					<input type="radio" name="method" value="Bank Transfer">
				</div>
				<button type="submit" name="order">Place Order</button>
			</form> -->

		</div>
		<footer>
			<?php include "footer.php" ?>
		</footer>
	</main>

</html>