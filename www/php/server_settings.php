<?php

	session_start();

	$errors = array();

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

	if(isset($_POST['settings_id_customer'])){
		$cust_id = $_POST['settings_id_customer'];
	}
	else {
		$cust_id = $_SESSION['customer_id'];
	}

	if($result = mysqli_query($db, "SELECT * FROM Customers WHERE ID_customer = '$cust_id'"))
	{
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$fam_name = $row["Family_name"];
		$fst_name = $row["First_name"];
		$date_birth = $row["Date_of_birth"];
		$card_number = $row["Card_number"];
		$exp_date = $row["Expiring_date"];
		$country = $row["Country"];
		$address = $row["Address"];
		$postal_code = $row["Postal_code"];
		$password = $row["Cust_password"];
		mysqli_free_result($result);
	}
	else echo "ERROR: " . mysqli_error($db);

	if(isset($_SESSION['err_payment']) and $_SESSION['err_payment'] == "invalid_data"){
		echo "<script>alert('Update the card data!')</script>";
		unset($_SESSION['err_payment']);
	}

	if(isset($_POST['personal-btn'])){
		$new_fam_name = $_POST['fam_name'];
		$new_fst_name = $_POST['fst_name'];
		$new_date_birth = $_POST['date_birth'];
		$curr_password = $_POST['curr_password'];
		$new_password = $_POST['new_password'];

		if(sha1($curr_password) == $password){
			$updateQuery = "UPDATE Customers SET Family_name = ?, First_name = ?, Date_of_birth = ?, Cust_password = sha1(?) WHERE ID_customer = ?";
			$stmt = mysqli_prepare($db, $updateQuery);
			if(empty($new_password))mysqli_stmt_bind_param($stmt, "sssss", $new_fam_name, $new_fst_name, $new_date_birth, $curr_password, $cust_id);
			else mysqli_stmt_bind_param($stmt, "sssss", $new_fam_name, $new_fst_name, $new_date_birth, $new_password, $cust_id);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_error($stmt)){
				echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
				exit();
			}
			else{
				echo "<meta http-equiv='refresh' content='0'>";
				echo '<script>alert("The data has been updated.")</script>'; 
			}
			mysqli_stmt_close($stmt);
		}
		else array_push($errors, "Current password is wrong!");
	}

	if(isset($_POST['payment-btn'])){
		$new_card_number = $_POST['card_number'];
		$new_exp_date = $_POST['exp_date'];
		$new_country = $_POST['country'];
		$new_address = $_POST['address'];
		$new_postal_code = $_POST['postal_code'];
		$curr_password = $_POST['curr_password'];

		if(sha1($curr_password) == $password){
			$updateQuery = "UPDATE Customers SET Card_number = ?, Expiring_date = ?, Country = ?, Address = ?, Postal_code = ? WHERE ID_customer = ?";
			$stmt = mysqli_prepare($db, $updateQuery);
			mysqli_stmt_bind_param($stmt, "ssssss", $new_card_number, $new_exp_date, $new_country, $new_address, $new_postal_code, $cust_id);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_error($stmt)){
				echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
				exit();
			}
			else{
				echo "<meta http-equiv='refresh' content='0'>";
				echo '<script>alert("The data has been updated.")</script>'; 
			}
			mysqli_stmt_close($stmt);
		}
		else array_push($errors, "Current password is wrong!");
	}

	mysqli_close($db);
?>