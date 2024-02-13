<?php

	session_start();

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(isset($_POST['contact-send-content'])){
		$fam_name = $_POST['fam_name'];
		$fst_name = $_POST['fst_name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		$myQuery = "INSERT INTO Inbox (Family_name, First_name, Email, Message, Subject) VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "sssss", $fam_name, $fst_name, $email, $message, $subject);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		else{
			echo "<meta http-equiv='refresh' content='0'>";
			echo '<script>alert("The message was sent.")</script>';
		}
		mysqli_stmt_close($stmt);
	}

	$dataPOST = file_get_contents('php://input');
	if(strcmp(substr($dataPOST,0,5),"<?xml") == 0){
		$dom = new DOMDocument();
		$dom->loadXML($dataPOST, LIBXML_NOENT | LIBXML_DTDLOAD);
		$xmlData = simplexml_import_dom($dom);
		if(strlen($xmlData->message) > 999){
			$message = substr($string,0,999);
		}
		else{
			$message = $xmlData->message;
		}

		$myQuery = "INSERT INTO Inbox (Family_name, First_name, Email, Message, Subject) VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($db, $myQuery);
		mysqli_stmt_bind_param($stmt, "sssss", $xmlData->fam_name, $xmlData->fst_name, $xmlData->email, $message, $xmlData->subject);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_error($stmt)){
			echo "Failed to execute MYSQL query: " . mysqli_stmt_error($stmt);
			exit();
		}
		else{
			echo "<meta http-equiv='refresh' content='0'>";
			$success = "You sent: " . $xmlData->message . " successfully!";
			echo "<script>alert('$success')</script>";
		}
		mysqli_stmt_close($stmt);
	}

	mysqli_close($db);
?>
