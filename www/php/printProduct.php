<?php
	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(isset($_GET['id_product']))
	{
		$id = $_GET['id_product'];

		$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE P.ID_product = ?";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		if($result->num_rows != 0)
		{
			while($row = $result->fetch_assoc())
			{
				$imag = $row['Image'];
				$description = $row['Description'];
				$aplications = $row['Aplications'];
				$prodname = $row['Product_name'];
				$categ = $row['Category_name'];
				$price = $row['Price_per_unit'];
				$quantity = $row['Number_of_units'];
				?>
				<div class="product-shop">
					<img src="<?php echo $imag; ?>" alt="<?php echo $prodname; ?>">
					<ul><b>Description</b>
						<?php
						while($pos = strpos($description, ';')){
							$aux = substr($description, 0, $pos);
							?><li><?php echo $aux;
							$description = substr($description, $pos+1);
						}
						?>
					</ul>
					<ul><b>Aplications</b>
						<?php
						while($pos = strpos($aplications, ';')){
							$aux = substr($aplications, 0, $pos);
							?><li><?php echo $aux;
							$aplications = substr($aplications, $pos+1);
						}
						?>
					</ul>
				</div>
				
				<div class="product-add">
					<h2><?php echo $prodname; ?></h2>
					<h4>In: <?php echo $categ; ?></h4>
					<p>From: <?php echo $price; ?> RON/unit</p>
					<form action="../html/cart.php" method="POST">
						<p>Quantity: <input type="number" name="quantity" id="quantity" min="1" value="1"></p>
						<button type="submit" class="add-in-cart-btn" name="add_in_cart_prod_id" value="<?php echo $id; ?>">Add in cart</button>
					</form>
				</div>
				<?php 
			}
		}
		else echo "<h2>We're sorry! Product not found..</h2>";
	}

	mysqli_close($db);
?>
