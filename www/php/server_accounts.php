<?php
	session_start();

	if(isset($_SESSION['logged_out'])){
		$_SESSION = array();
		session_destroy();
	}

	$errors = array();

	//connect to database
	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	
	//if the login button is clicked
	if(isset($_POST['login']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		$myQuery = "SELECT * FROM Customers WHERE Email = ? and Cust_password = sha1(?)";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "ss", $email, $password);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		if($result->num_rows != 0){
			if($row = $result->fetch_assoc()){
				session_regenerate_id();
				$_SESSION['user_email'] = $email;
				$_SESSION['customer_id'] = $row['ID_customer'];
				if($email == "admin")
					header('location: admin-home.php');
				else header('location: ../index.php');
			}
		}
		else array_push($errors, "The account is not valid!");
	}

	$fam_name = "";
	$fst_name = "";
	$email = "";

	//if the register button is clicked
	if(isset($_POST['register']))
	{
		$fam_name = $_POST['fam_name'];
		$fst_name = $_POST['fam_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$myQuery = "SELECT * FROM Customers WHERE Email = ?";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		if($result->num_rows > 0) array_push($errors, "The email was already registered!");

		// if there were no errors pushed, save user
		if(count($errors) == 0)
		{
			$insertQuery = "INSERT INTO Customers (Family_name, First_name, Email, Cust_password) VALUES (?, ?, ?, sha1(?))";
			$stmt = mysqli_prepare($db, $insertQuery);
			mysqli_stmt_bind_param($stmt, "ssss", $fam_name, $fst_name, $email, $password);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_error($stmt)){
				echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
				exit();
			}
			mysqli_stmt_close($stmt);
			$stmt = mysqli_prepare($db, $myQuery);
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_error($stmt)){
				echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
				exit();
			}
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			$row = $result->fetch_assoc();
			session_regenerate_id();
			$_SESSION['user_email'] = $email;
			$_SESSION['customer_id'] = $row['ID_customer'];
			header('location: ../index.php');
		}
	}

	mysqli_close($db);
?>
