<?php
	session_start();

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(isset($_SESSION['user_email']))
	{
		$email = $_SESSION['user_email'];
		$getIdQuery="SELECT ID_customer FROM Customers WHERE Email = '$email'";
		if($result = mysqli_query($db, $getIdQuery)){
			$row = mysqli_fetch_array($result);
			$user_id = $row['ID_customer'];
			mysqli_free_result($result);
		}
		else echo "ERROR: " . mysqli_error($db);
	}
	else {
		header('location: ../html/login.php');
		exit();
	}

	if(isset($_POST['del_product_id']))
	{
		$prod_id = $_POST['del_product_id'];

		if($prod_id == 0){
			$myQuery = "DELETE FROM Cart WHERE ID_customer = ? and Status = 'Active'";
			$stmt = mysqli_prepare($db, $myQuery);
			mysqli_stmt_bind_param($stmt, "i", $user_id);
		}
		else {
			$myQuery = "DELETE FROM Cart WHERE ID_customer = ? and ID_product = ? and Status = 'Active'";
			$stmt = mysqli_prepare($db, $myQuery);
			mysqli_stmt_bind_param($stmt, "ii", $user_id, $prod_id);
		}
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		mysqli_stmt_close($stmt);
	}

	if(isset($_POST['change_q_quantity']))
	{
		$quantity = $_POST['change_q_quantity'];
		$id_prod = $_POST['change_q_prod_id'];

		$myQuery = "UPDATE Cart SET Quantity = $quantity WHERE ID_customer = $user_id and ID_product = $id_prod and Status = 'Active'";
		$result = mysqli_query($db, $myQuery);
		if(!$result){
			echo "ERROR: " . mysqli_error($db);
		}
	}

	if(isset($_POST['add_in_cart_prod_id']))
	{
		$id_prod = $_POST['add_in_cart_prod_id'];
		$quantity = $_POST['quantity'];

		$verifQuery = "SELECT * FROM Cart WHERE ID_customer = ? and ID_product = ? and Status = 'Active'";
		$stmt = mysqli_prepare($db, $verifQuery);
		mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_prod);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		$verify = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		if($verify->num_rows > 0){
			$myQuery = "UPDATE Cart SET Quantity = Quantity+? WHERE ID_customer = ? and ID_product = ?";
			$stmt = mysqli_prepare($db, $myQuery);
			mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $id_prod);
		}
		else {
			$myQuery = "INSERT INTO Cart(ID_product,ID_customer,Quantity,Status) VALUES(?, ?, ?, 'Active')";
			$stmt = mysqli_prepare($db, $myQuery);
			mysqli_stmt_bind_param($stmt, "iii", $id_prod, $user_id, $quantity);
		}
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		mysqli_stmt_close($stmt);
	}

	if(isset($_GET['sum']))
	{
		if($_GET['sum'] != $_SESSION['buy_sum']){
			echo '<img src="../images/nicetry.gif">';
			exit();
		}
		
		$sum = $_SESSION['buy_sum'];
		unset($_SESSION['buy_sum']);
		$errors = array();

		if($sum == 0){
			header('location: ../html/products.php');
			exit();
		}

		$getPayDetails = "SELECT * FROM Customers WHERE ID_customer = $user_id";
		if($payment = mysqli_query($db, $getPayDetails)){
			$row = mysqli_fetch_array($payment);
			if(empty($row['Card_number']) || empty($row['Expiring_date']) || empty($row['Country']) || empty($row['Address']) || empty($row['Postal_code'])){
				$_SESSION['err_payment'] = "invalid_data";
				header('location: ../html/settings.php');
				exit();
			}
			mysqli_free_result($payment);
		}
		else echo "ERROR: " . mysqli_error($db);

		$getProductsQuery="SELECT * FROM Cart inner join Products on Cart.ID_product = Products.ID_product WHERE ID_customer = $user_id and Status = 'Active'";
		if($subProducts = mysqli_query($db,$getProductsQuery)){
			if (mysqli_num_rows($subProducts) > 0){
				while($row = mysqli_fetch_array($subProducts)){
					$idCart = $row['ID_cart'];
					$productName = $row['Product_name'];
					$nrStock = $row['Number_of_units'];
					$nrCart = $row['Quantity'];
					if($nrCart < 0)array_push($errors, "We're sorry! You cannot buy products with negative quantity!");
					else {
						if($nrStock-$nrCart < 0)array_push($errors, "We're sorry! Only <b>$nrStock</b> pieces of the <b>$productName</b> product are still available!");
						else {
							$myQuery="UPDATE Products inner join Cart on Cart.ID_product = Products.ID_product SET Products.Number_of_units = $nrStock - $nrCart WHERE Cart.ID_cart = $idCart";
							$result = mysqli_query($db, $myQuery);
							if(!$result){
								echo "ERROR: " . mysqli_error($db);
							}
						}
					}
				}
				mysqli_free_result($subProducts);
			}
			else {
				header('location: ../html/products.php');
				exit();
			}
		}
		else echo "ERROR: " . mysqli_error($db);

		$getCartQuery="SELECT * FROM Cart WHERE ID_customer = $user_id and Status = 'Active'";
		if(empty($errors)){
			if($getCart = mysqli_query($db, $getCartQuery)){
				$getNrQuery="SELECT ID_internal_order FROM Orders inner join Cart on Orders.ID_cart = Cart.ID_cart WHERE Cart.ID_customer = $user_id";
				if($check = mysqli_query($db, $getNrQuery)){
					if (mysqli_num_rows($check) > 0){
						while($row = mysqli_fetch_array($check)){
							$id_internal = $row['ID_internal_order'] + 1;
						}
						mysqli_free_result($check);
					}
					else $id_internal = 1;
				}
				else echo "ERROR: " . mysqli_error($db);	

				while($row = mysqli_fetch_array($getCart)){
					$cart_id = $row['ID_cart'];
					$insertTotalDueQuery="INSERT INTO Orders(ID_internal_order,ID_cart,Total_due) VALUES(?,?,?)";
					$stmt = mysqli_prepare($db, $insertTotalDueQuery);
					mysqli_stmt_bind_param($stmt, "iii", $id_internal, $cart_id, $sum);
					mysqli_stmt_execute($stmt);
					if(mysqli_stmt_error($stmt)){
						echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
						exit();
					}
					mysqli_stmt_close($stmt);
				}
				mysqli_free_result($getCart);

				$updateCartQuery="UPDATE Cart SET Status = 'Ordered' WHERE ID_customer = $user_id and Status = 'Active'";
				if($result = mysqli_query($db, $updateCartQuery)){
					echo "<script>alert('Products have been bought successfully!')</script>";
				}
				else echo "ERROR: " . mysqli_error($db);
			}
			else echo "ERROR: " . mysqli_error($db);
		}
	}

	mysqli_close($db);
?>
