<?php

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(isset($_SESSION['user_email'])){
		$email = $_SESSION['user_email'];
	}
	else{
		header('location: ../html/login.php');
		exit();
	}

	$myQuery = "SELECT P.*, Ca.*, Cu.* FROM Cart as Ca INNER JOIN Products as P ON Ca.ID_product = P.ID_product INNER JOIN Customers as Cu ON Ca.ID_customer = Cu.ID_customer WHERE Cu.Email = ? and Ca.Status = 'Active'";
	$stmt = mysqli_prepare($db, $myQuery);
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	if(mysqli_stmt_error($stmt)){
		echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
		exit();
	}
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	
	?>
	<div class="cart-content">
		<?php include '../php/server_errors.php'; ?>
		<table id="table" border="1">
	<?php
	$subtotal = 0;
	while($row = $result->fetch_assoc()){
		$subtotal = $subtotal + ($row['Price_per_unit'] * $row['Quantity']);
		?>
		<tr>
			<td rowspan="2"><img src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Product_name']; ?>"></td>
			<th><?php echo $row['Product_name']; ?></th>
			<th>Price/unit(RON)</th>
			<th>Quantity(UNITS)</th>
			<th rowspan="2">
				<form action="" method="post">
					<button type="submit" name="del_product_id" value="<?php echo $row['ID_product']; ?>"><b>Delete product</b></button>
				</form>
			</th>
		</tr>
		<tr>
			<td>ID product: <?php echo $row['ID_product']; ?></td>
			<td><?php echo $row['Price_per_unit']; ?></td>
			<td>
				<form action="" method="post" id="form-change-q-<?php echo $row['ID_product'] ?>">
					<input type="hidden" name="change_q_prod_id" value="<?php echo $row['ID_product']; ?>">
					<input type="number" name="change_q_quantity" min="1" value="<?php echo $row['Quantity']; ?>" onchange="document.getElementById('form-change-q-<?php echo $row['ID_product'] ?>').submit();">
				</form>	
			</td>
		</tr>
		<?php
	}
	?>
	<tr>
		<td></td>
		<td></td>
		<td>
			Subtotal: <?php echo $subtotal ?> RON
		</td>
		<td></td>
		<th>
			<form action="" method="post">
				<button type="submit" name="del_product_id" value="0"><b>Empty cart</b></button>
			</form>
		</th>
	</tr>
	</table>
	</div>
	<div class="buy-content">
		<h1>Your order</h1>
		<hr>
		<h5>Total due:</h5>
		<h2>
			<?php 
				$total = 0;
				if($subtotal == 0){
					echo 0;
				}
				else{
					$total = $subtotal + 25;
					echo $total;
				}
				$_SESSION['buy_sum'] = $total;
			?> RON
		</h2>
		<hr>
		<p>Please have a download help ready!</p>
		<p>Total cost of transport: 25 RON</p>
		<button id="cart-buy-btn" name="cart-buy-btn" onclick="location.href='../html/cart.php?sum=<?php echo $total; ?>'">Buy</button>
	</div>
	<?php

	mysqli_close($db);
	
?>
