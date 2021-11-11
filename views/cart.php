<?php
// API for emptying your cart
if(isset($_GET['empty'])){
	unset($_SESSION['transaction']);
}

// API for removing a transaction in cart
if(isset($_GET['remove'])){
	$id = $_GET['remove'];
	foreach($_SESSION['transaction'] as $k => $part){
		if($id == $part['productid']){
			unset($_SESSION['transaction'][$k]);
		}
	}
}

// Total amount of money
$total = 0;
?>


<div class="table">
	<a class='empty' href="checkout.php?empty=1">EmptyCart</a>
	<table style="border-bottom: 1px #e3e3e3 solid; margin-bottom:20px;">
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Remove</th>
		</tr>

		<!-- Transactions in cart are fetched from user's session -->
		<?php if(isset($_SESSION['transaction'])) :?>
			<?php foreach($_SESSION['transaction'] as $k => $item) :?>
				<tr>
					<td><?php echo $item['productname']; ?></td>
					<td><?php echo $item['quantity']; ?></td>
					<td>
						<?php echo $item['price'] * $item['quantity']; 
						$pro = $item['price'] * $item['quantity'];
						$total = $total + $pro;?>
					</td>
					<td><a href="checkout.php?remove=<?php echo $item['productid']; ?>"><i class="fas fa-times"></i></a></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>

	<div class="total" style="float: right;">
		<h2>Total Rs: <span><?php echo $total; ?></span></h2>
	</div>
</div>

<form action="cart.php" method="POST">
	<?php if(isset($success)){echo $success;} ?>
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
</form>
