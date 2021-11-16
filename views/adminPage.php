<?php
session_start();
?>

<?php
include '../controllers/admin.controller.php';
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
		<?php include "admin_header.php" ?>
	</header>

	<main role="main">
		<div class="container-fluid" style="display: block;">


			<!-- Transactions in cart are fetched from user's session -->
			<?php
			if ($_GET) {
				$_SESSION['redirect_url'] = "../index.php/admin?userid=" . $_GET['userid'];

				$admin = new AdminController();
				$listStaff = $admin->getListAccount();

				if ($listStaff && mysqli_num_rows($listStaff) > 0) { ?>
                    <form action="../controllers/admin_processing.php" method="POST">
						<input type="hidden" name="adminID" value="<?php echo $_GET['userid'] ?>" />
						<input type="submit" name="action" value="New staff" class="btn btn-success"/>
					</form>

					<div class="cart-table" style="width: 100%;">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Name</th>
									<th scope="col">Username</th>
									<th scope="col">Phone</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>

								<?php while ($staff = $listStaff->fetch_assoc()) {
								?>
									<tr>
										<td><?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?></td>
										<td><?php echo $staff['username']; ?></td>
                                        <td><?php echo $staff['phone']; ?></td>
										<td>
											<form action="../controllers/admin_processing.php" method="POST">
												<input type="hidden" name="adminID" value="<?php echo $_GET['userid'] ?>" />
												<input type="hidden" name="userID" value="<?php echo $staff['uid'] ?>" />
												<input type="submit" name="action" value="Remove" class="btn btn-danger" />
											</form>
										</td>
									</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>
                    <?php } else { ?>
					<div style="text-align: center; padding: 50px;">
						<a class='btn btn-primary' style="font-size: 3rem;" href="./home">List staff are empty!</a>
					</div>
				<?php }} ?>
		</div>
		<footer>
			<?php include "footer.php" ?>
		</footer>
	</main>

</html>