<?php

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(isset($_POST["search"])){
		$searchItem = $_POST["searchItem"];
		$output=null;
		$retval=null;
		exec("../scripts/search_products.sh $searchItem", $output, $retval);
		$searchItem = "%$searchItem%";
		$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE P.Product_name LIKE ?";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "s", $searchItem);
	}
	else {
		$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category";
		$stmt = mysqli_prepare($db, $myQuery);
	}

	if (isset($_POST["waterproofing"]))
		$argumentsCateg[] = "C.Category_name = 'Waterproofing'";
	if (isset($_POST["thermal_insulation"]))
		$argumentsCateg[] = "C.Category_name = 'Thermal and phono insulation'";
	if (isset($_POST["facades_finishes"]))
		$argumentsCateg[] = "C.Category_name = 'Facades and finishes'";
	if (isset($_POST["roofs"]))
		$argumentsCateg[] = "C.Category_name = 'Roofs'";
	if (isset($_POST["ordinary"]))
		$argumentsAvailability[] = "P.Availability = 'Ordinary'";
	if (isset($_POST["premium"]))
		$argumentsAvailability[] = "P.Availability = 'Premium'";
	if (isset($_POST["new"]))
		$argumentsAvailability[] = "P.Availability = 'New'";
	if (isset($_POST['min_price']) && isset($_POST['max_price'])){
		$min = $_POST['min_price'];
		$max = $_POST['max_price'];
		if(!empty($min) && !empty($max))
			$argumentsPrice = "P.Price_per_unit > ? and P.Price_per_unit < ?";
		else if(!empty($min) && empty($max))
			$argumentsPrice = "P.Price_per_unit > ?";
		else if(empty($min) && !empty($max))
			$argumentsPrice = "P.Price_per_unit < ?";
		else $argumentsPrice = "";
	}
	if (!isset($_POST['min_price']) && !isset($_POST['max_price'])){
		$argumentsPrice = "";
	}

	if(isset($_POST['price-submit'])){
		$min = $_POST['min_price'];
		$max = $_POST['max_price'];
		if(!empty($min) && !empty($max))
			$argumentsPrice = "P.Price_per_unit > ? and P.Price_per_unit < ?";
		else if(!empty($min) && empty($max))
			$argumentsPrice = "P.Price_per_unit > ?";
		else if(empty($min) && !empty($max))
			$argumentsPrice = "P.Price_per_unit < ?";
		else $argumentsPrice = "";
	}
	if(!empty($argumentsCateg) && !empty($argumentsAvailability)){
		$strCateg = implode(' or ', $argumentsCateg);
		$strAvailability = implode(' or ', $argumentsAvailability);
		if(!empty($argumentsPrice)){
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE (" . $strCateg . ") and (" . $strAvailability . ") and (" . $argumentsPrice . ")";
			if(!empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "ii", $_POST['min_price'], $_POST['max_price']);
			}
			else if(!empty($_POST['min_price']) && empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['min_price']);
			}
			else if(empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['max_price']);
			}
		}
		else {
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE (" . $strCateg . ") and (" . $strAvailability . ")";
			$stmt = mysqli_prepare($db, $myQuery);
		}
	}
	else if(!empty($argumentsCateg) && empty($argumentsAvailability)){
		$strCateg = implode(' or ', $argumentsCateg);
		if(!empty($argumentsPrice)){
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE (" . $strCateg . ") and (" . $argumentsPrice . ")";
			if(!empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "ii", $_POST['min_price'], $_POST['max_price']);
			}
			else if(!empty($_POST['min_price']) && empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['min_price']);
			}
			else if(empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['max_price']);
			}
		}
		else {
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE " . $strCateg;
			$stmt = mysqli_prepare($db, $myQuery);
		}
	}
	else if(empty($argumentsCateg) && !empty($argumentsAvailability)){
		$strAvailability = implode(' or ', $argumentsAvailability);
		if(!empty($argumentsPrice)){
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE (" . $strAvailability . ") and (" . $argumentsPrice . ")";
			if(!empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "ii", $_POST['min_price'], $_POST['max_price']);
			}
			else if(!empty($_POST['min_price']) && empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['min_price']);
			}
			else if(empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['max_price']);
			}
		}
		else {
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE " . $strAvailability;
			$stmt = mysqli_prepare($db, $myQuery);
		}
	}
	else {
		if(!empty($argumentsPrice)){
			$myQuery = "SELECT P.*,C.Category_name FROM Products as P INNER JOIN MaterialsCategory as C ON P.ID_category = C.ID_category WHERE " . $argumentsPrice;
			if(!empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "ii", $_POST['min_price'], $_POST['max_price']);
			}
			else if(!empty($_POST['min_price']) && empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['min_price']);
			}
			else if(empty($_POST['min_price']) && !empty($_POST['max_price'])){
				$stmt = mysqli_prepare($db, $myQuery);
				mysqli_stmt_bind_param($stmt, "i", $_POST['max_price']);
			}
		}
	}

	mysqli_stmt_execute($stmt);
	if(mysqli_stmt_error($stmt)){
		echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
		exit();
	}
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	while($row = $result->fetch_assoc()){
		$id = $row['ID_product'];
		$product = $row['Product_name'];
		$image = $row['Image'];
		$price = $row['Price_per_unit'];
		$categ = $row['Category_name'];
		?>
		<div class="gallery">
			<a href="product.php?id_product=<?php echo $id; ?>">
			<img src="<?php echo $image; ?>" alt="<?php echo $product; ?>" width="400" height="400">
			<div class="desc">
				<span class="nameP"><?php echo $product; ?></span><br><br>
				<span class="categoryP">in <?php echo $categ; ?></span><br><br>
				from <span class="priceP"><?php echo $price; ?></span> RON
			</div>
			</a>
			<form action="../html/cart.php" method="post">
				<input type="hidden" name="quantity" value="1">
				<button type="submit" class="cart-add-btn" name="add_in_cart_prod_id" value="<?php echo $id; ?>">Add in cart</button>
			</form>
		</div>
	<?php }

	mysqli_close($db);

?>