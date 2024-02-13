<?php 
	session_start();

	if(!(isset($_SESSION['user_email']) and $_SESSION['user_email'] == "admin")){
		header('location: ../html/login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/admin-home-style.css">
	<title>Home</title>
</head>

<body>
<div class="header">
	<h1><b>HOME PAGE</b><br>construct.ro</h1>
	<h3>~ Authorised access only ~</h3>
</div>

<div class="menu-buttons">
	<button type="button" id="users" class="mybutton" onclick="location.href='admin-users.php'">Users</button>
	<button id="products" class="mybutton">Products</button>
	<button id="contact" class="mybutton">Contact</button>
	<button type="button" id="logout" class="mybutton" onclick="location.href='login.php'">Log out</button>
	<script>
		const logout_link = document.getElementById('logout');
		logout_link.addEventListener("click", () => {
			<?php $_SESSION['logged_out'] = True; ?>
		});
	</script>
</div>
</body>

</html>
