<?php

	session_start();

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(!(isset($_SESSION['user_email']) and $_SESSION['user_email'] == "admin")){
		header('location: ../html/login.php');
		exit();
	}
	
	if(isset($_POST['administration-add-content']))
	{
		$new_fam_name = $_POST['fam_name'];
		$new_fst_name = $_POST['fst_name'];
		$new_email = $_POST['email'];
		$new_password = $_POST['new_password'];

		$myQuery = "SELECT Email FROM Customers WHERE Email = ?";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "s", $new_email);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		if($result->num_rows > 0)echo "<script>alert('This email already exists!')</script>";
		else {
			if(empty($new_password))echo "<script>alert('Password can not be empty!')</script>";
			else {
				$insertQuery = "INSERT INTO Customers(Family_name,First_name,Email,Cust_password) VALUES(?,?,?,sha1(?))";
				$stmt = mysqli_prepare($db, $insertQuery);
				mysqli_stmt_bind_param($stmt, "ssss", $new_fam_name, $new_fst_name, $new_email, $new_password);
				mysqli_stmt_execute($stmt);
				if(mysqli_stmt_error($stmt)){
					echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
					exit();
				}
				else{
					echo "<meta http-equiv='refresh' content='0'>";
					echo "<script>alert('The data has been updated')</script>"; 
				}
				mysqli_stmt_close($stmt);
			}
		}
	}

	if(isset($_POST['administration-update-content']))
	{
		$new_fam_name = $_POST['fam_name'];
		$new_fst_name = $_POST['fst_name'];
		$new_email = $_POST['email'];
		$new_password = $_POST['new_password'];
		$old_email = $_POST['old_email'];

		$myQuery = "SELECT Email FROM Customers WHERE Email = ?";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "s", $new_email);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		if(($result->num_rows > 0) && ($new_email != $old_email))echo "<script>alert('The email already exists!')</script>";
		else {
			if(empty($new_password)){
				$updateQuery = "UPDATE Customers SET Family_name = ?, First_name = ?, Email = ? WHERE Email = ?";
				$stmt = mysqli_prepare($db, $updateQuery);
				mysqli_stmt_bind_param($stmt, "ssss", $new_fam_name, $new_fst_name, $new_email, $old_email);
			}
			else {
				$updateQuery = "UPDATE Customers SET Family_name = ?, First_name = ?, Email = ?, Cust_password = sha1(?) WHERE Email = ?";
				$stmt = mysqli_prepare($db, $updateQuery);
				mysqli_stmt_bind_param($stmt, "sssss", $new_fam_name, $new_fst_name, $new_email, $new_password, $old_email);
			}
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_error($stmt)){
				echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
				exit();
			}
			else{
				echo "<meta http-equiv='refresh' content='0'>";
				echo "<script>alert('The data has been updated')</script>"; 
			}
			mysqli_stmt_close($stmt);
		}
	}

	if(isset($_POST['administration-remove-content']))
	{
		$old_email = $_POST['old_email'];
 
		$deleteQuery = "DELETE FROM Customers WHERE Email = ?";
		$stmt = mysqli_prepare($db, $deleteQuery);
		mysqli_stmt_bind_param($stmt, "s", $old_email);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		else{
			echo "<meta http-equiv='refresh' content='0'>";
			echo "<script>alert('The data has been updated.')</script>";
		}
		mysqli_stmt_close($stmt);
	}

	mysqli_close($db);
?>