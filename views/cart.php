<?php
// API for emptying your cart
if (isset($_GET['empty'])) {
	unset($_SESSION['transaction']);
}

// API for removing a transaction in cart
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];
	foreach ($_SESSION['transaction'] as $k => $part) {
		if ($id == $part['productid']) {
			unset($_SESSION['transaction'][$k]);
		}
	}
}


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
											<td><a class="btn btn-danger" href="#" role="button">Remove</a></td>
										</tr>

									<?php } ?>

								</tbody>

							<?php } else { ?>
								<a class='empty' href="#">EmptyCart</a>
						<?php }
					} ?>

							</table>

							<div class="total" style="float: right;">
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